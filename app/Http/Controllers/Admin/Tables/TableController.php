<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Http\Resources\TableResource;
use App\Models\Tables\Table;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TableController extends Controller
{
    private string $routeResourceName = 'tables';

    public function __construct()
    {
        $this->middleware('can:view Tables list')->only('index');
        $this->middleware('can:create Table')->only(['create', 'store']);
        $this->middleware('can:update,Table')->only(['edit', 'update']);
        $this->middleware('can:delete,Table')->only('destroy');
    }

    public function index(Request $request)
    {
        $Tables = Table::query()
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Tables/Index', [
            'title' => 'Tables',
            'items' => TableResource::collection($Tables),
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
                'create' => $request->user()->can('create Table'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Tables/Create', [
            'edit' => false,
            'title' => 'Add Table',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(TableRequest $request)
    {
        $Table = Table::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Table created successfully.');
    }

    public function edit(Table $Table)
    {
        return Inertia::render('Tables/Create', [
            'edit' => true,
            'title' => 'Edit Table',
            'item' => new TableResource($Table),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(TableRequest $request, Table $Table)
    {
        $Table->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Table updated successfully.');
    }

    public function destroy(Table $content)
    {
        $content->delete();

        return back()->with('success', 'Table deleted successfully.');
    }
}

