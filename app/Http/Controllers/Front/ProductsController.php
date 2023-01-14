<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __invoke(Request $request)
    {
        $sortByItems = collect([
            ['name' => 'Price (High to Low)', 'identifier' => 'price-high-to-low'],
            ['name' => 'Price (Low to High)', 'identifier' => 'price-low-to-high'],
        ]);

        return view('front.pages.products.index', [
            'title' => 'Products',
            'products' => Product::active()->paginate(16),
            'sortByItems' => $sortByItems,
            'currentSortedItem' => $sortByItems->firstWhere('identifier', $request->sortby)['name'] ?? null,
        ]);
    }
}
