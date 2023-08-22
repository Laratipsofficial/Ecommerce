<?php

namespace App\Http\Controllers\Admin\Menus;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuSectionRequest;
use App\Http\Resources\MenuSectionResource;
use App\Models\Menu\MenuSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuSectionController extends Controller
{

    private string $routeResourceName = 'menus-sections';

    public function __construct()
    {
        $this->middleware('can:view menu list')->only('index');
        $this->middleware('can:create menu')->only(['create', 'store']);
        $this->middleware('can:edit menu')->only(['edit', 'update']);
        $this->middleware('can:delete menu')->only('destroy');
    }

    public function index(Request $request)
    {
        $MenuSections = MenuSection::query()
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Menus/Sections/Index', [
            'title' => 'MenuSections',
            'items' => MenuSectionResource::collection($MenuSections),
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
        return Inertia::render('Menus/Sections/Create', [
            'edit' => false,
            'title' => 'Add MenuSection',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(MenuSectionRequest $request)
    {
        $MenuSection = MenuSection::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuSection created successfully.');
    }

    public function edit(MenuSection $menuSection)
    {
        return Inertia::render('Menus/Sections/Create', [
            'edit' => true,
            'title' => 'Edit MenuSection',
            'item' => new MenuSectionResource($menuSection),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(MenuSection $menuSection, MenuSectionRequest $request)
    {
        $menuSection->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'MenuSection updated successfully.');
    }

    public function destroy(MenuSection $menuSection)
    {
        $menuSection->delete();

        return back()->with('success', 'MenuSection deleted successfully.');
    }
}

