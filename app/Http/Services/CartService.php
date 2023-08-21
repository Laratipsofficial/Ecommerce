<?php

namespace App\Http\Services;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSideItem;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use App\Models\Orders\OrderStatus;
use App\Models\Orders\OrderType;
use Illuminate\Support\Facades\Session;

class CartService
{
    private $cartKey = 'cart';
    private CurrentTableService $currentTableService;

    public function __construct(CurrentTableService $currentTableService)
    {
        $this->currentTableService = $currentTableService;
    }


    public function add($cartItem)
    {
        $cart = $this->getCart();
        $cartItemID = uniqid(); // Generate a unique ID for the cart item

        $cartItem = [
            'id' => $cartItemID,
            'menu_item_id' => $cartItem['menu_item_id'],
            'menu_side_item_id' => $cartItem['menu_side_item_id'],
            'quantity' => $cartItem['quantity'],
            'comment' => $cartItem['comment'],
        ];

        $cart[$cartItemID] = $cartItem;

        $this->saveCart($cart);
    }

    public function remove($cartItemID)
    {
        $cart = $this->getCart();

        if (isset($cart[$cartItemID])) {
            unset($cart[$cartItemID]);
            $this->saveCart($cart);
        }
    }

    public function getCart()
    {
        return Session::get($this->cartKey, []);
    }

    private function saveCart($cart)
    {
        Session::put($this->cartKey, $cart);
    }

    public function clearCart()
    {
        Session::forget($this->cartKey);
    }

    public function canCheckOut()
    {
        // if is take away, then return true
        if ($this->isTakeAway()) {
            return true;
        }

        // if the last order item of the order has not been 10 minutes ago, then return false
        // also the round should 5 or less
        $round = $this->currentTableService->getRound();
        $order_id = $this->currentTableService->getOrderId();

        if(!$order_id){
            return true;
        }

        // get last order item of the order, order by created_at desc
        $lastOrderItem = OrderItem::where('order_id', $order_id)->orderBy('created_at', 'desc')->first();

        // check if the last order item is null
        if (!$lastOrderItem) {
            return true;
        }


        // check if the last order item is older than 10 minutes and the round is 5 or less
        if ($lastOrderItem->created_at->diffInMinutes(now()) > 10 && $round <= 5) {
            return true;
        }

        return false;
    }

    public function checkOut(): bool
    {
        // check if the order can be checked out
        if (!$this->canCheckOut()) {
            return false;
        }

        $cart = $this->getCart();

        // get order id
        $order_id = $this->currentTableService->getOrderId();
        $round = $this->currentTableService->getRound();

        // if the order id is null, then create order
        if (!$order_id && $this->isTablet()) {
            $order = $this->currentTableService->createOrder();
            $order_id = $order->id;
        } else if (!$order_id && $this->isTakeAway()) {
            // create order
            $order = Order::create([
                'status_id' => OrderStatus::get()->first()->id,
                'type_id' => OrderType::where('name', 'take-away')->first()->id,
            ]);
            $order_id = $order->id;
        }

        // create order items
        foreach ($cart as $cartItem) {
            $menu_item = MenuItem::find($cartItem['menu_item_id']);

            OrderItem::create([
                'order_id' => $order_id,
                'menu_item_id' => $cartItem['menu_item_id'],
                'menu_side_item_id' => $cartItem['menu_side_item_id'],
                'quantity' => $cartItem['quantity'],
                'comment' => $cartItem['comment'],
                'table_round' => $round,
                'price' => $menu_item->price,
                'discount' => $menu_item->discount,
            ]);
        }

        // increment round if is tablet
        if ($this->isTablet()){
            $this->currentTableService->incrementRound();
        }

        // clear cart
        $this->clearCart();

        // if is take away store a cookie with the order id
        if ($this->isTakeAway()) {
            $this->currentTableService->setOrderId($order_id);
        }

        return true;
    }

    public function isTablet()
    {
        return $this->currentTableService->has();
    }

    public function isTakeAway()
    {
        return !$this->currentTableService->has();
    }

    // get items from cart and return them as an array with the menu item model
    public function getItems()
    {
        $cart = $this->getCart();
        $items = [];

        foreach ($cart as $cartItem) {
            $menu_item = MenuItem::find($cartItem['menu_item_id']);
            $menu_side_item = MenuSideItem::find($cartItem['menu_side_item_id']);

            $items[] = [
                'id' => $cartItem['id'],
                'menu_item' => $menu_item,
                'menu_side_item' => $menu_side_item,
                'quantity' => $cartItem['quantity'],
                'comment' => $cartItem['comment'],
            ];
        }

        return $items;
    }
}
