<?php

namespace App\Http\Controllers\TakeAway;

use App\Http\Controllers\Controller;
use App\Http\Services\CurrentTableService;
use App\Models\Orders\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HistoryController extends Controller
{
    private CurrentTableService $currentTableService;
    private string $routeResourceName = 'history';

    public function __construct(CurrentTableService $currentTableService)
    {
        $this->currentTableService = $currentTableService;
    }

    public function index()
    {
        $order_id = $this->currentTableService->getOrderId();

        $order = Order::find($order_id);

        // get all order items grouped by round
        $order_items = $order->items()->get()->groupBy('table_round');

        return Inertia::render('TakeAway/History/Index', [
            'title' => 'History',
            'items' => $order_items,
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
[
                    'label' => 'Quantity',
                    'name' => 'quantity',
                ],
                [
                    'label' => 'Price',
                    'name' => 'price',
                ],
                [
                    'label' => 'Total',
                    'name' => 'total',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                    'align' => 'center',
                ],
            ],
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    // reorder round or item from history
    // if the request has table_round, then reorder the round
    // if the request has order_item_id, then reorder the item
    public function store(Request $request)
    {
        $order_id = $this->currentTableService->getOrderId();

        $order = Order::find($order_id);

        if ($request->has('table_round')) {
            $table_round = $request->table_round;

            $order_items = $order->items()->where('table_round', $table_round)->get();

            foreach ($order_items as $order_item) {
                $order_item->table_round = $order_item->table_round + 1;
                $order_item->save();
            }
        }

        if ($request->has('order_item_id')) {
            $order_item_id = $request->order_item_id;

            $order_item = $order->items()->find($order_item_id);

            $order_item->table_round = $order_item->table_round + 1;
            $order_item->save();
        }

        return redirect()->route('tablets.history.index');
    }
}
