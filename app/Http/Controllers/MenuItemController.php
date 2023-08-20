<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Models\Menu\MenuItem;

class MenuItemController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', MenuItem::class);

        return MenuItemResource::collection(MenuItem::all());
    }

    public function store(MenuItemRequest $request)
    {
        $this->authorize('create', MenuItem::class);

        return new MenuItemResource(MenuItem::create($request->validated()));
    }

    public function show(MenuItem $menuItem)
    {
        $this->authorize('view', $menuItem);

        return new MenuItemResource($menuItem);
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {
        $this->authorize('update', $menuItem);

        $menuItem->update($request->validated());

        return new MenuItemResource($menuItem);
    }

    public function destroy(MenuItem $menuItem)
    {
        $this->authorize('delete', $menuItem);

        $menuItem->delete();

        return response()->json();
    }
}
