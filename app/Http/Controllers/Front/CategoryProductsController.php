<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{
    public function __invoke(Request $request, Category $category)
    {
        return view('front.pages.products.index', [
            'title' => "{$category->name} Products",
            'products' => $category->products()->active()->paginate(16),
        ]);
    }
}
