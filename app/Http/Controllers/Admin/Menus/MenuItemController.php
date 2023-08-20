<?php

namespace App\Http\Controllers\Admin\Menus;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuSectionResource;
use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuItemController extends Controller
{

    private string $routeResourceName = 'menus-items';

    public function __construct()
    {
        $this->middleware('can:view MenuItems list')->only('index');
        $this->middleware('can:create MenuItem')->only(['create', 'store']);
        $this->middleware('can:update,MenuItem')->only(['edit', 'update']);
        $this->middleware('can:delete,MenuItem')->only('destroy');
    }

    public function index(Request $request)
    {
        $MenuItems = MenuItem::query()
            // return the menu item if it has the same menu section id as the request menu section id
                // or if the name of the menu item is like the request search or if the request search is like the full number of the menu item
                // the full number is the number and the number addition of the menu item not stored in the database
            ->when(
                // if the request menu section id is not null
                $request->menu_section_id !== null,
                // return the menu item if it has the same menu section id as the request menu section id
                fn (Builder $builder) => $builder->where('menu_section_id', $request->menu_section_id)
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

        $menuSections = MenuSection::all();

        return Inertia::render('Menus/Items/Index', [
            'title' => 'MenuItems',
            'items' => MenuItemResource::collection($MenuItems),
            'menuSections' => MenuSectionResource::collection($menuSections),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
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

    public function create()
    {
        $menuSections = MenuSection::all();

        return Inertia::render('Menus/Items/Create', [
            'edit' => false,
            'title' => 'Add MenuItem',
            'routeResourceName' => $this->routeResourceName,
            'menuSections' => MenuSectionResource::collection($menuSections),
        ]);
    }

    public function store(MenuItemRequest $request)
    {
        $MenuItem = MenuItem::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuItem created successfully.');
    }

    public function edit(MenuItem $menuItem)
    {
        return Inertia::render('Menus/Items/Create', [
            'edit' => true,
            'title' => 'Edit MenuItem',
            'item' => new MenuItemResource($menuItem),
            'menuSections' => MenuSectionResource::collection(MenuSection::all()),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {
        $menuItem->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuItem updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return back()->with('success', 'MenuItem deleted successfully.');
    }
}
