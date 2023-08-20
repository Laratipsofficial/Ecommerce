<?php

namespace App\Http\Controllers;

use App\Http\Requests\CmsContentRequest;
use App\Http\Resources\CmsContentResource;
use App\Models\Content\CmsContent;

class CmsContentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', CmsContent::class);

        return CmsContentResource::collection(CmsContent::all());
    }

    public function store(CmsContentRequest $request)
    {
        $this->authorize('create', CmsContent::class);

        return new CmsContentResource(CmsContent::create($request->validated()));
    }

    public function show(CmsContent $cmsContent)
    {
        $this->authorize('view', $cmsContent);

        return new CmsContentResource($cmsContent);
    }

    public function update(CmsContentRequest $request, CmsContent $cmsContent)
    {
        $this->authorize('update', $cmsContent);

        $cmsContent->update($request->validated());

        return new CmsContentResource($cmsContent);
    }

    public function destroy(CmsContent $cmsContent)
    {
        $this->authorize('delete', $cmsContent);

        $cmsContent->delete();

        return response()->json();
    }
}
