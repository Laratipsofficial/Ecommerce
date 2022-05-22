<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriesRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Spatie\Permission\Models\Role;

class CategoriesController extends Controller
{
    private string $routeResourceName = 'categories';

    public function __construct()
    {
        $this->middleware('can:view categories list')->only('index');
        $this->middleware('can:create category')->only(['create', 'store']);
        $this->middleware('can:edit category')->only(['edit', 'update']);
        $this->middleware('can:delete category')->only('destroy');
    }

    public function index(Request $request)
    {
        $categories = Category::query()
            ->select([
                'id',
                'parent_id',
                'name',
                'created_at',
                'active',
            ])
            ->withCount([
                'children'
            ])
            ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->when(
                $request->parentId,
                fn (Builder $builder) => $builder->where('parent_id', $request->parentId),
                fn (Builder $builder) => $builder->root()
            )
            ->when(
                $request->active !== null,
                fn (Builder $builder) => $builder->when(
                    $request->active,
                    fn (Builder $builder) => $builder->active(),
                    fn (Builder $builder) => $builder->inActive()
                )
            )
            ->latest('id')
            ->paginate(100);

        return Inertia::render('Category/Index', [
            'title' => 'Categories',
            'items' => CategoryResource::collection($categories),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Children',
                    'name' => 'children_count',
                ],
                [
                    'label' => 'Active',
                    'name' => 'active',
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'rootCategories' => CategoryResource::collection(Category::root()->get(['id', 'name'])),
            'can' => [
                'create' => $request->user()->can('create category'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create', [
            'edit' => false,
            'title' => 'Add Category',
            'routeResourceName' => $this->routeResourceName,
            'rootCategories' => CategoryResource::collection(Category::root()->get(['id', 'name'])),
        ]);
    }

    public function store(CategoriesRequest $request)
    {
        $data = $request->safe()->only(['name', 'slug', 'active']);
        $data['parent_id'] = $request->parentId;

        $category = Category::create($data);

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Category/Create', [
            'edit' => true,
            'title' => 'Edit Category',
            'item' => new CategoryResource($category),
            'routeResourceName' => $this->routeResourceName,
            'rootCategories' => CategoryResource::collection(Category::root()->where('id', '!=', $category->id)->get(['id', 'name'])),
        ]);
    }

    public function update(CategoriesRequest $request, Category $category)
    {
        $data = $request->safe()->only(['name', 'slug', 'active']);
        $data['parent_id'] = $request->parentId;

        $category->update($data);

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
