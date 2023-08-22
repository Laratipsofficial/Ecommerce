<?php

namespace App\Http\Controllers\TakeAway;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        // also add items
        $order->load('items');

        return Inertia::render('TakeAway/Orders/Confirmation', [
            'item' => $order,
        ]);
    }
}
