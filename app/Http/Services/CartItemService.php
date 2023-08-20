<?php

namespace App\Http\Services;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSideItem;

class CartItemService
{
    public function __construct(
        protected CartService $cartService,
    )
    {
    }

    public function addCartItem(MenuItem $menuItem, int $quantity, MenuSideItem $menuSideItem = null)
    {
        $cart = $this->cartService->getCart();

        $cart[$menuItem->id] = [
            'menu_item_id' => $menuItem->id,
            'quantity' => $quantity,
        ];

        if ($menuSideItem) {
            $cart[$menuItem->id]['menu_side_item_id'] = $menuSideItem->id;
        }

        session(['cart' => $cart]);
    }
}
