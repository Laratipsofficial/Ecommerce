<?php

namespace App\Http\Controllers\TakeAway;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tablets\Menus\TabletMenuRequest;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuSectionResource;
use App\Http\Services\CartService;
use App\Http\Services\CurrentTableService;
use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSection;
use App\Models\Menu\MenuSideItem;
use App\Models\Tables\Table;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{

    private string $routeResourceName = 'menus';
    private CartService $cartItemService;
    private CurrentTableService $currentTableService;

    public function __construct(CartService $cartItemService, CurrentTableService $currentTableService)
    {
        $this->middleware('can:view MenuItems list')->only('index');
        $this->middleware('can:create MenuItem')->only(['create', 'store']);
        $this->middleware('can:update,MenuItem')->only(['edit', 'update']);
        $this->middleware('can:delete,MenuItem')->only('destroy');
        $this->cartItemService = $cartItemService;
        $this->currentTableService = $currentTableService;
    }

    public function index(Request $request)
    {
        $MenuItems = MenuItem::query()
            // return the menu item if it has the same menu section id as the request menu section id
            // or if the name of the menu item is like the request search or if the request search is like the full number of the menu item
            // the full number is the number and the number addition of the menu item not stored in the database
            ->when(
            // if the request menu section id is not null
                $request->menuSectionId !== null,
                // return the menu item if it has the same menu section id as the request menu section id
                fn (Builder $builder) => $builder->where('menu_section_id', $request->menuSectionId)
            )
            ->when(
                $request->search,
                // the full number is the number and the number addition of the menu item not stored in the database
                // merge the number and the number addition of the menu item and check if the request search is like the full number
                fn (Builder $builder) => $builder->whereRaw("CONCAT(number, number_addition) LIKE '%{$request->search}%'")
                    ->orWhere('name', 'like', "%{$request->search}%")
            )
            ->latest('id')
            ->paginate(10);

        // add the full number to the menu item
        $MenuItems->getCollection()->transform(function (MenuItem $menuItem) {
            $menuItem->full_number = "{$menuItem->number}{$menuItem->number_addition}";

            return $menuItem;
        });

        $menuSections = MenuSection::all();
        $round = $this->currentTableService->getRound();
        $table_id = $this->currentTableService->get(); // cast to int
        $table = Table::find($table_id);

        return Inertia::render('TakeAway/Menus/Index', [
            'title' => 'MenuItems',
            'items' => MenuItemResource::collection($MenuItems),
            'menuSections' => MenuSectionResource::collection($menuSections),
            'headers' => [
                [
                    'label' => 'Number',
                    'name' => 'full_number',
                ],
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Price',
                    'name' => 'price',
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

    public function show(MenuItem $menuItem)
    {
        $sideDishes = MenuSideItem::all();

        return Inertia::render('TakeAway/Menus/Show', [
            'title' => 'Add ' . $menuItem->name . ' to cart - price: €' . $menuItem->current_price,
            'item' => $menuItem,
            'sideDishes' => $sideDishes,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(TabletMenuRequest $request, MenuItem $menuItem)
    {
        $cartItem = [
            'menu_item_id' => $menuItem->id,
            'quantity' => $request->quantity,
            'menu_side_item_id' => $request->menu_side_item_id,
            'comment' => $request->comment ?? '',
        ];

        $this->cartItemService->add($cartItem);


        // update the cart items that have the same menu item id as the request menu item id

        return redirect()->route("takeaway.{$this->routeResourceName}.index")->with('success', 'MenuItem created successfully.');
    }
}
