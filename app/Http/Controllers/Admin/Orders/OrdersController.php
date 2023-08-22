<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderResource;
use App\Models\Orders\Order;
use App\Models\Orders\OrderStatus;
use App\Models\Orders\OrderType;
use App\Models\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersController extends Controller
{
    private string $routeResourceName = 'orders';

    public function __construct()
    {
        $this->middleware('can:view orders list')->only('index');
        $this->middleware('can:create order')->only(['create', 'store']);
        $this->middleware('can:update,order')->only(['edit', 'update']);
        $this->middleware('can:delete,order')->only('destroy');
    }

    public function index(Request $request)
    {
        $orderStatuses = OrderStatus::query()
            ->select(['id', 'name'])
            ->get();

        $orderTypes = OrderType::query()
            ->select(['id', 'name'])
            ->get();

        $tables = Table::all();

        $orders = Order::query()
            ->select()
            ->when($request->status_id, fn (Builder $builder, $statusId) =>
                $builder->where('status_id', $statusId)->when($request->type_id, fn (Builder $builder, $typeId) =>
                    $builder->where('type_id', $typeId)->when($request->table_id, fn (Builder $builder, $tableId) =>
                        $builder->where('table_id', $tableId)
                    )
                ))
            ->with(['status:name,id', 'type:name,id', 'table:number,id'])
            // order by latest id
            ->orderBy('id', 'desc')
            ->latest('id')
            ->paginate(10);

        // dot

        return Inertia::render('Order/Index', [
            'title' => 'Orders',
            'items' => OrderResource::collection($orders),
            'headers' => [
                [
                    'label' => 'Id',
                    'name' => 'id',
                ],
                [
                    'label' => 'Status',
                    'name' => 'status.name',
                ],
                [
                    'label' => 'Type',
                    'name' => 'type.name',
                ],
                [
                    'label' => 'Table',
                    'name' => 'table.number',
                ],
                [
                    'label' => 'Total Price',
                    'name' => 'total_price',
                ],
                [
                    'label' => 'Created Date',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            'orderStatuses' => $orderStatuses,
            'orderTypes' => $orderTypes,
            'tables' => $tables,
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => $request->user()->can('create order'),
                'edit' => $request->user()->can('edit order'),
            ],
        ]);
    }

    public function create()
    {
        $orderStatuses = OrderStatus::query()
            ->select(['id', 'name'])
            ->get();

        $orderTypes = OrderType::query()
            ->select(['id', 'name'])
            ->get();

        $tables = Table::all();

        return Inertia::render('Order/Create', [
            'edit' => false,
            'title' => 'Add Order',
            'orderStatuses' => $orderStatuses,
            'orderTypes' => $orderTypes,
            'tables' => $tables,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $orderStatuses = OrderStatus::query()
            ->select(['id', 'name'])
            ->get();

        $orderTypes = OrderType::query()
            ->select(['id', 'name'])
            ->get();

        $tables = Table::all();

        $order->load(['items']);

        return Inertia::render('Order/Create', [
            'edit' => true,
            'title' => 'Edit Order',
            'item' => $order,
            'orderStatuses' => $orderStatuses,
            'orderTypes' => $orderTypes,
            'tables' => $tables,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('success', 'Order deleted successfully.');
    }
}
