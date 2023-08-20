<?php

namespace App\Http\Controllers\Admin\Menus;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Http\Resources\MenuSectionResource;
use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSection;
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
        return Inertia::render('Menus/Items/Create', [
            'edit' => false,
            'title' => 'Add MenuItem',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(MenuItemRequest $request)
    {
        $MenuItem = MenuItem::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuItem created successfully.');
    }

    public function edit(MenuItem $MenuItem)
    {
        return Inertia::render('Menus/Items/Create', [
            'edit' => true,
            'title' => 'Edit MenuItem',
            'item' => new MenuItemResource($MenuItem),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(MenuItemRequest $request, MenuItem $MenuItem)
    {
        $MenuItem->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuItem updated successfully.');
    }

    public function destroy(MenuItem $content)
    {
        $content->delete();

        return back()->with('success', 'MenuItem deleted successfully.');
    }
}
