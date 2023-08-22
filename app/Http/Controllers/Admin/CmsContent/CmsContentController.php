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
        $this->middleware('can:view content list')->only('index');
        $this->middleware('can:create content')->only(['create', 'store']);
        $this->middleware('can:edit content')->only(['edit', 'update']);
        $this->middleware('can:delete content')->only('destroy');
    }

    public function index(Request $request)
    {
        $content = CmsContent::query()
            ->latest('id')
            ->paginate(10);

        return Inertia::render('CmsContent/Index', [
            'title' => 'content',
            'items' => CmsContentResource::collection($content),
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
                'create' => $request->user()->can('create content'),
                'edit' => $request->user()->can('edit content'),
                'delete' => $request->user()->can('delete content'),
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

    public function edit(CmsContent $content)
    {
        return Inertia::render('CmsContent/Create', [
            'edit' => true,
            'title' => 'Edit CmsContent',
            'item' => new CmsContentResource($content),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(CmsContentRequest $request, CmsContent $content)
    {
        $content->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'CmsContent updated successfully.');
    }

    public function destroy(CmsContent $content)
    {
        $content->delete();

        return back()->with('success', 'CmsContent deleted successfully.');
    }
}
