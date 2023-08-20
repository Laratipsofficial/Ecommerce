<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuSideItemRequest;
use App\Http\Resources\MenuSideItemResource;
use App\Models\Menu\MenuSideItem;

class MenuSideItemController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', MenuSideItem::class);

        return MenuSideItemResource::collection(MenuSideItem::all());
    }

    public function store(MenuSideItemRequest $request)
    {
        $this->authorize('create', MenuSideItem::class);

        return new MenuSideItemResource(MenuSideItem::create($request->validated()));
    }

    public function show(MenuSideItem $menuSideItem)
    {
        $this->authorize('view', $menuSideItem);

        return new MenuSideItemResource($menuSideItem);
    }

    public function update(MenuSideItemRequest $request, MenuSideItem $menuSideItem)
    {
        $this->authorize('update', $menuSideItem);

        $menuSideItem->update($request->validated());

        return new MenuSideItemResource($menuSideItem);
    }

    public function destroy(MenuSideItem $menuSideItem)
    {
        $this->authorize('delete', $menuSideItem);

        $menuSideItem->delete();

        return response()->json();
    }
}
