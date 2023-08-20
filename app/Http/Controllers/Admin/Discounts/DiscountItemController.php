<?php

namespace App\Http\Controllers\Admin\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountItemRequest;
use App\Http\Requests\MenuItemRequest;
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
        $this->middleware('can:view MenuItems list')->only('index');
        $this->middleware('can:create MenuItem')->only(['create', 'store']);
        $this->middleware('can:update,MenuItem')->only(['edit', 'update']);
        $this->middleware('can:delete,MenuItem')->only('destroy');
    }

    public function index(Request $request, Discount $discount)
    {
        $items = DiscountItem::query()
            ->where('discount_id', $discount->id)
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Menus/Items/Index', [
            'title' => 'MenuItems',
            'items' => MenuItemResource::collection($items),
            'parent' => $discount,
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
        $menuSections = MenuSection::all();

        return Inertia::render('Menus/Items/Create', [
            'edit' => false,
            'title' => 'Add MenuItem',
            'routeResourceName' => $this->routeResourceName,
            'menuSections' => MenuSectionResource::collection($menuSections),
        ]);
    }

    public function store(DiscountItemRequest $request, Discount $discount)
    {
        $MenuItem = MenuItem::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuItem created successfully.');
    }

    public function edit(DiscountItem $discountItem, Discount $discount)
    {
        return Inertia::render('Menus/Items/Create', [
            'edit' => true,
            'title' => 'Edit MenuItem',
            'item' => new MenuItemResource($discountItem),
            'menuSections' => MenuSectionResource::collection(MenuSection::all()),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(DiscountItemRequest $request, DiscountItem $discountItem, Discount $discount)
    {
        $discountItem->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuItem updated successfully.');
    }

    public function destroy(DiscountItem $discountItem)
    {
        $discountItem->delete();

        return back()->with('success', 'MenuItem deleted successfully.');
    }
}
