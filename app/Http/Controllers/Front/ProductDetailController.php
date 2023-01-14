<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function __invoke(Request $request, Product $product)
    {
        return view('front.pages.products.show', [
            'product' => $product,
        ]);
    }
}
