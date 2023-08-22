<?php

namespace App\Http\Controllers\Admin\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountItemRequest;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\DiscountItemResource;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuSectionResource;
use App\Models\Discount\Discount;
use App\Models\Discount\DiscountItem;
use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscountItemController extends Controller
{

    private string $routeResourceName = 'discounts.items';

    public function __construct()
    {
        $this->middleware('can:view discounts list')->only('index');
        $this->middleware('can:create discount')->only(['create', 'store']);
        $this->middleware('can:update,discount')->only(['edit', 'update']);
        $this->middleware('can:delete,discount')->only('destroy');
    }

    public function index(Request $request, Discount $discount)
    {
        $items = DiscountItem::query()
            ->where('discount_id', $discount->id)
            // add all the a
            ->with(['menuItem:id,name,price'])
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Discounts/Items/Index', [
            'title' => 'Discount Items' . ' - ' . $discount->name,
            'items' => $items,
            'discount' => $discount,
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Price',
                    'name' => 'price',
                ],
                [
                    'label' => 'Discount',
                    'name' => 'discount',
                ],
                [
                    'label' => 'Discounted Price',
                    'name' => 'discounted_price',
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
                'create' => $request->user()->can('create MenuItem'),
            ],
        ]);
    }

    public function create(Discount $discount)
    {
        return Inertia::render('Discounts/Items/Create', [
            'edit' => false,
            'title' => 'Add Discount Item',
            'discount' => $discount,
            'routeResourceName' => $this->routeResourceName,
            'menuItems' => MenuItemResource::collection(MenuItem::all()),
        ]);
    }

    public function store(DiscountItemRequest $request, Discount $discount, DiscountItem $discountItem)
    {
        $discount->discountItems()->create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Discount item created successfully.');
    }

    public function edit(Discount $discount, DiscountItem $discountItem)
    {
        return Inertia::render('Discounts/Items/Create', [
            'edit' => true,
            'title' => 'Edit MenuItem',
            'item' => new DiscountItemResource($discountItem),
            'discount' => $discount,
            'menuItems' => MenuItemResource::collection(MenuItem::all()),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(DiscountItemRequest $request, Discount $discount, DiscountItem $discountItem)
    {
        $discountItem->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index", $discount->id)->with('success', 'MenuItem updated successfully.');
    }

    public function destroy(Discount $discount, DiscountItem $discountItem)
    {
        // delete item from discount
        $discount->discountItems()->where('menu_item_id', $discountItem->id)->delete();

        return back()->with('success', 'MenuItem deleted successfully.');
    }
}
