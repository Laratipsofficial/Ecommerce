<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItemRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSideItem;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersItemsController extends Controller
{
    private string $routeResourceName = 'orders.items';

    public function __construct()
    {
        $this->middleware('can:view orders list')->only('index');
        $this->middleware('can:create order')->only(['create', 'store']);
        $this->middleware('can:update,order')->only(['edit', 'update']);
        $this->middleware('can:delete,order')->only('destroy');
    }

    public function index(Request $request, Order $order)
    {
        // order by table round
        // also add the total price of the order item and the menu item name and the menu side item name
        // paginate the order items

        $orderItems = OrderItem::query()
            ->where('order_id', $order->id)
            ->orderBy('table_round')
            ->with(['menuItem:id,name', 'menuSideItem:id,name'])
            ->select([
                'id',
                'table_round',
                'order_id',
                'menu_item_id',
                'price',
                'quantity',
                'menu_side_item_id',
                'created_at',
                'updated_at',
            ])
            ->when($request->tableRound, fn (Builder $builder, $tableRound) => $builder->where('table_round', 'like', "%{$tableRound}%"))
            ->paginate(10);

        return Inertia::render('Order/Items/Index', [
            'title' => 'Orders',
            'items' => OrderItemResource::collection($orderItems),
            'order' => new OrderResource($order),
            'headers' => [
                [
                    'label' => 'Menu item',
                    'name' => 'name',
                ],
                [
                    'label' => 'Table Round',
                    'name' => 'table_round',
                ],
                [
                    'label' => 'Quantity',
                    'name' => 'quantity',
                ],
                [
                    'label' => 'Price',
                    'name' => 'price',
                ],
                [
                    'label' => 'Total Price',
                    'name' => 'total_price',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                    'align' => 'center',
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => $request->user()->can('create order'),
            ],
        ]);
    }

    public function create(Order $order)
    {

        $menuItems = MenuItem::get();

        $menuSideItems = MenuSideItem::all(['id', 'name']);

        $comments = OrderItem::getComments();

        return Inertia::render('Order/Items/Create', [
            'edit' => false,
            'title' => 'Add Order',
            'order' => new OrderResource($order),
            'menuItems' => $menuItems,
            'comments' => $comments,
            'menuSideItems' => $menuSideItems,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(OrderItemRequest $request, Order $order)
    {
        $orderItem = $order->items()->create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index", $order->id)->with('success', 'Order created successfully.');
    }

    public function edit(Order $order, OrderItem $orderItem)
    {
        // add menu item name and menu side item name
        $orderItem->load(['menuItem:id,name', 'menuSideItem:id,name']);

        $menuItems = MenuItem::all(['id', 'name']);

        $comments = OrderItem::getComments();

        $menuSideItems = MenuSideItem::all(['id', 'name']);

        return Inertia::render('Order/Items/Create', [
            'edit' => true,
            'title' => 'Edit Order',
            'order' => new OrderResource($order),
            'comments' => $comments,
            'item' => OrderItemResource::make($orderItem),
            'menuItems' => $menuItems,
            'menuSideItems' => $menuSideItems,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(OrderItemRequest $request, Order $order, OrderItem $orderItem)
    {
        $orderItem->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index", $order->id)->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order, OrderItem $orderItem)
    {
        $orderItem->delete();

        return back()->with('success', 'Order deleted successfully.');
    }
}
