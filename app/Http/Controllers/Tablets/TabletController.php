<?php

namespace App\Http\Controllers\Tablets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tablets\StoreTableRequest;
use App\Http\Services\CurrentTableService;
use App\Models\Tables\Table;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TabletController extends Controller
{
    private CurrentTableService $currentTableService;
    private string $routeResourceName = 'tablets';

    public function __construct(CurrentTableService $currentTableService)
    {
        $this->currentTableService = $currentTableService;
    }

    public function index()
    {
        // check if session has table_id
        // if not, redirect to /tablets/create
        // if yes, redirect to /tablets/menus
        $table_id = session('table_id');

        if (!$table_id) {
            return redirect()->route('tablets.create');
        }

        return redirect()->route('tablets.menus.index');
    }

    public function create()
    {
        $tables = Table::all();

        return Inertia::render('Tablets/Index', [
            'tables' => $tables,
            'routeResourceName' => 'tablets',
        ]);
    }

    public function store(StoreTableRequest $request)
    {
        $table_id = $request->validated()['table_id'];


        $this->currentTableService->set($table_id);

        return redirect()->route('tablets.menus.index');
    }

    public function reset()
    {
        $this->currentTableService->clear();

        return redirect()->route('tablets.create');
    }
}
