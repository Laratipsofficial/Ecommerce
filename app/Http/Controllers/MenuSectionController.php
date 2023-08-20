<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuSectionRequest;
use App\Http\Resources\MenuSectionResource;
use App\Models\Menu\MenuSection;

class MenuSectionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', MenuSection::class);

        return MenuSectionResource::collection(MenuSection::all());
    }

    public function store(MenuSectionRequest $request)
    {
        $this->authorize('create', MenuSection::class);

        return new MenuSectionResource(MenuSection::create($request->validated()));
    }

    public function show(MenuSection $menuSection)
    {
        $this->authorize('view', $menuSection);

        return new MenuSectionResource($menuSection);
    }

    public function update(MenuSectionRequest $request, MenuSection $menuSection)
    {
        $this->authorize('update', $menuSection);

        $menuSection->update($request->validated());

        return new MenuSectionResource($menuSection);
    }

    public function destroy(MenuSection $menuSection)
    {
        $this->authorize('delete', $menuSection);

        $menuSection->delete();

        return response()->json();
    }
}
