<?php

namespace App\Http\Controllers\Admin\CmsContent;

use App\Http\Controllers\Controller;
use App\Http\Requests\CmsContentRequest;
use App\Http\Resources\CmsContentResource;
use App\Models\Content\CmsContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CmsContentController extends Controller
{
    private string $routeResourceName = 'content';

    public function __construct()
    {
        $this->middleware('can:view CmsContents list')->only('index');
        $this->middleware('can:create CmsContent')->only(['create', 'store']);
        $this->middleware('can:update,CmsContent')->only(['edit', 'update']);
        $this->middleware('can:delete,CmsContent')->only('destroy');
    }

    public function index(Request $request)
    {
        $CmsContents = CmsContent::query()
            ->latest('id')
            ->paginate(10);

        return Inertia::render('CmsContent/Index', [
            'title' => 'CmsContents',
            'items' => CmsContentResource::collection($CmsContents),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                // seo_title
                [
                    'label' => 'Seo Title',
                    'name' => 'seo_title',
                ],
                // slug
                [
                    'label' => 'Slug',
                    'name' => 'slug',
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
                'create' => $request->user()->can('create CmsContent'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('CmsContent/Create', [
            'edit' => false,
            'title' => 'Add CmsContent',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(CmsContentRequest $request)
    {
        $CmsContent = CmsContent::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'CmsContent created successfully.');
    }

    public function edit(CmsContent $CmsContent)
    {
        return Inertia::render('CmsContent/Create', [
            'edit' => true,
            'title' => 'Edit CmsContent',
            'item' => new CmsContentResource($CmsContent),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(CmsContentRequest $request, CmsContent $CmsContent)
    {
        $CmsContent->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'CmsContent updated successfully.');
    }

    public function destroy(CmsContent $content)
    {
        $content->delete();

        return back()->with('success', 'CmsContent deleted successfully.');
    }
}
