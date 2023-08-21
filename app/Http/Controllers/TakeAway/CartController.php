<?php

namespace App\Http\Controllers\TakeAway;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Http\Services\CurrentTableService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    private CartService $cartService;
    private CurrentTableService $currentTableService;
    private string $routeResourceName = 'cart';

    public function __construct(CartService $cartService, CurrentTableService $currentTableService)
    {
        $this->cartService = $cartService;
        $this->currentTableService = $currentTableService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();

        $items = $this->cartService->getItems();

        return Inertia::render('TakeAway/Cart/Index', [
            'cart' => $cart,
            'items' => $items,
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    // is checkout
    public function create()
    {
        // get order to pass to confirmation page
        $checkout = $this->cartService->checkOut();

        $orderid = $this->currentTableService->getOrderId();

        if ($checkout) {
            return redirect()->route('takeaway.order.show', $orderid)->with('success', 'Checkout successfully');
        }

        return redirect()->route('takeaway.cart.index')->with('success', 'You need to wait 10 minutes before you can checkout again, if you ordered more than 5 times please contact the waiter');
    }

    public function destroy(string $cartItem)
    {
        $this->cartService->remove($cartItem);

        return redirect()->route('takeaway.cart.index')->with('success', 'Cart item removed successfully');
    }
}
