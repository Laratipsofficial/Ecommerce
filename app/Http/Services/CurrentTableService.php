<?php

namespace App\Http\Services;

use App\Models\Orders\Order;
use App\Models\Orders\OrderStatus;
use App\Models\Orders\OrderType;

class CurrentTableService
{
    public function get()
    {
        return session('table_id');
    }

    public function set($table_id)
    {
        session(['table_id' => $table_id]);
        // create order and add the id to session

        $order = $this->createOrder();

        // set round to 1
        $this->incrementRound();

        session(['order_id' => $order->id]);

    }

    public function clear()
    {
        session()->forget('table_id');
        session()->forget('round');
        session()->forget('cart');
        session()->forget('order_id');
    }

    public function has()
    {
        return session()->has('table_id');
    }

    public function getOrderId()
    {
        return session('order_id', null);
    }

    public function createOrder()
    {
        $table_id = $this->get();

        if (!$table_id) {
            return null;
        }

        $type = OrderType::where('name', 'dine-in')->first();
        $status = OrderStatus::get()->first();

        $order = Order::create([
            'table_id' => $table_id,
            'type_id' => $type->id,
            'status_id' => $status->id,
        ]);

        return $order;
    }

    public function getRound()
    {
        return session('round');
    }

    public function incrementRound()
    {
        $round = $this->getRound();

        if (!$round) {
            $round = 1;
        } else {
            $round++;
        }

        session(['round' => $round]);
    }
}
