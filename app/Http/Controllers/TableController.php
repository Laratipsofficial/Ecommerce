<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Http\Resources\TableResource;
use App\Models\Tables\Table;

class TableController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Table::class);

        return TableResource::collection(Table::all());
    }

    public function store(TableRequest $request)
    {
        $this->authorize('create', Table::class);

        return new TableResource(Table::create($request->validated()));
    }

    public function show(Table $table)
    {
        $this->authorize('view', $table);

        return new TableResource($table);
    }

    public function update(TableRequest $request, Table $table)
    {
        $this->authorize('update', $table);

        $table->update($request->validated());

        return new TableResource($table);
    }

    public function destroy(Table $table)
    {
        $this->authorize('delete', $table);

        $table->delete();

        return response()->json();
    }
}
