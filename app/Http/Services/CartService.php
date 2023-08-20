<?php

namespace App\Http\Services;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSideItem;
use PhpParser\Node\Expr\List_;

class CartService
{
    // this service is used to get the cart from session

    public function getCart() : array
    {
        return session('cart', []);
    }

    public function checkOut()
    {
        $cart = $this->getCart();

        // create order


        // create order items
        foreach ($cart as $cartItem) {

        }

        // clear cart
        session()->forget('cart');
    }
}
