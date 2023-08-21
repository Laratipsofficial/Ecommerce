<?php

namespace App\Http\Controllers\Tablets;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    private CartService $cartService;
    private string $routeResourceName = 'cart';

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();

        $items = $this->cartService->getItems();

        return Inertia::render('Tablets/Cart/Index', [
            'cart' => $cart,
            'items' => $items,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    // is checkout
    public function create()
    {
        $checkout = $this->cartService->checkOut();

        if ($checkout) {
            return redirect()->route('tablets.menus.index')->with('success', 'Checkout successfully');
        }

        return redirect()->route('tablets.cart.index')->with('success', 'You need to wait 10 minutes before you can checkout again, if you ordered more than 5 times please contact the waiter');
    }

    public function destroy(string $cartItem)
    {
        $this->cartService->remove($cartItem);

        return redirect()->route('tablets.cart.index')->with('success', 'Cart item removed successfully');
    }
}
