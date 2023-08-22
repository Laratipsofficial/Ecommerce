<?php

namespace App\Http\Controllers\Admin\Menus;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuSideItemRequest;
use App\Http\Resources\MenuSideItemResource;
use App\Models\Menu\MenuSideItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuSideItemController extends Controller
{

    private string $routeResourceName = 'menus-side-items';

    public function __construct()
    {
        $this->middleware('can:view menu list')->only('index');
        $this->middleware('can:create menu')->only(['create', 'store']);
        $this->middleware('can:edit menu')->only(['edit', 'update']);
        $this->middleware('can:delete menu')->only('destroy');
    }

    public function index(Request $request)
    {
        $MenuSideItems = MenuSideItem::query()
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Menus/SideItems/Index', [
            'title' => 'MenuSideItems',
            'items' => MenuSideItemResource::collection($MenuSideItems),
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
                'create' => $request->user()->can('create menu'),
                'edit' => $request->user()->can('edit menu'),
                'delete' => $request->user()->can('delete menu'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Menus/SideItems/Create', [
            'edit' => false,
            'title' => 'Add MenuSideItem',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(MenuSideItemRequest $request)
    {
        $MenuSideItem = MenuSideItem::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuSideItem created successfully.');
    }

    public function edit(MenuSideItem $menuSideItem)
    {
        return Inertia::render('Menus/SideItems/Create', [
            'edit' => true,
            'title' => 'Edit MenuSideItem',
            'item' => $menuSideItem,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(MenuSideItemRequest $request, MenuSideItem $menuSideItem)
    {
        $menuSideItem->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuSideItem updated successfully.');
    }

    public function destroy(MenuSideItem $menuSideItem)
    {
        $menuSideItem->delete();

        return back()->with('success', 'MenuSideItem deleted successfully.');
    }
}

