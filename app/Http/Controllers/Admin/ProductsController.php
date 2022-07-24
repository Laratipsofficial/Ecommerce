<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Spatie\Permission\Models\Role;

class ProductsController extends Controller
{
    private string $routeResourceName = 'products';

    public function __construct()
    {
        $this->middleware('can:view products list')->only('index');
        $this->middleware('can:create product')->only(['create', 'store']);
        $this->middleware('can:update,product')->only(['edit', 'update']);
        $this->middleware('can:delete,product')->only('destroy');
    }

    public function index(Request $request)
    {
        $products = Product::query()
            ->select([
                'id',
                'name',
                'cost_price',
                'price',
                'created_at',
                'show_on_slider',
                'featured',
                'active',
                'creator_id',
            ])
            ->with(['creator:id,name'])
            ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->when(
                $request->categoryId,
                fn (Builder $builder, $categoryId) => $builder->whereHas(
                    'categories',
                    fn (Builder $builder) => $builder->where('categories.id', $categoryId)
                )
            )
            ->when(
                $request->subCategoryId,
                fn (Builder $builder, $subCategoryId) => $builder->whereHas(
                    'categories',
                    fn (Builder $builder) => $builder->where('categories.id', $subCategoryId)
                )
            )
            ->when(
                $request->active !== null,
                fn (Builder $builder) => $builder->when(
                    $request->active,
                    fn (Builder $builder) => $builder->active(),
                    fn (Builder $builder) => $builder->inActive()
                )
            )
            ->when(
                $request->featured !== null,
                fn (Builder $builder) => $builder->where('featured', $request->featured)
            )
            ->when(
                $request->showOnSlider !== null,
                fn (Builder $builder) => $builder->where('show_on_slider', $request->showOnSlider)
            )
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Product/Index', [
            'title' => 'Products',
            'items' => ProductResource::collection($products),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Cost Price',
                    'name' => 'cost_price',
                ],
                [
                    'label' => 'Selling Price',
                    'name' => 'price',
                ],
                [
                    'label' => 'On Slider',
                    'name' => 'show_on_slider',
                ],
                [
                    'label' => 'Featured',
                    'name' => 'featured',
                ],
                [
                    'label' => 'Active',
                    'name' => 'active',
                ],
                [
                    'label' => 'Created Date',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Created By',
                    'name' => 'creator_id',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'categories' => CategoryResource::collection(
                Category::root()->with(['children:id,name,parent_id'])->get(['id', 'name'])
            ),
            'can' => [
                'create' => $request->user()->can('create product'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Product/Create', [
            'edit' => false,
            'title' => 'Add Product',
            'routeResourceName' => $this->routeResourceName,
            'categories' => CategoryResource::collection(
                Category::root()->with(['children:id,name,parent_id'])->get(['id', 'name'])
            ),
        ]);
    }

    public function store(ProductsRequest $request)
    {
        $product = Product::create($request->saveData());

        $product->categories()->attach($request->categoryIds());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['categories:id,parent_id', 'media']);

        return Inertia::render('Product/Create', [
            'edit' => true,
            'title' => 'Edit Product',
            'item' => new ProductResource($product),
            'routeResourceName' => $this->routeResourceName,
            'categories' => CategoryResource::collection(
                Category::root()->with(['children:id,name,parent_id'])->get(['id', 'name'])
            ),
        ]);
    }

    public function update(ProductsRequest $request, Product $product)
    {
        $product->update($request->saveData());

        $product->categories()->sync($request->categoryIds());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
}
