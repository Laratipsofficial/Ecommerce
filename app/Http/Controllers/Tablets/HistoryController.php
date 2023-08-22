<?php

namespace App\Http\Controllers\Tablets;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Http\Services\CurrentTableService;
use App\Models\Orders\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HistoryController extends Controller
{
    private CurrentTableService $currentTableService;
    private CartService $cartService;
    private string $routeResourceName = 'history';

    public function __construct(CurrentTableService $currentTableService, CartService $cartService)
    {
        $this->currentTableService = $currentTableService;
        $this->cartService = $cartService;
    }

    public function index()
    {
        $order_id = $this->currentTableService->getOrderId();

        $order = Order::find($order_id);

        $order_rounds = $order->items()->orderBy('table_round')->get()->groupBy('table_round');

        $round_data = [];

        foreach ($order_rounds as $table_round => $items) {
            $order_items = [];

            foreach ($items as $order_item) {
                $order_items[] = [
                    'name' => $order_item->menuItem->name,
                    'quantity' => $order_item->quantity,
                    'price' => $order_item->price,
                    'total' => $order_item->total_price,
                    'side_item' => $order_item->sideItem->name ?? '',
                    'actions' => [
                        'reorder' => [
                            'route' => route('tablets.history.store'),
                            'params' => [
                                'table_round' => $table_round,
                            ],
                        ],
                    ],
                ];
            }

            $round_data[] = [
                'table_round' => $table_round,
                'items' => $order_items,
            ];
        }


        // make it an array
        $order_rounds = $order_rounds->toArray();

        return Inertia::render('Tablets/History/Index', [
            'title' => 'History',
            'items' => $order_rounds,
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

    // reorder round or item from history, but add to cart
    // expect a request with table_round or order_item_id
    // a cart item will be created for each order item
    // a car item looks like this:
//$cartItem = [
//'id' => $cartItemID,
//'menu_item_id' => $cartItem['menu_item_id'],
//'menu_side_item_id' => $cartItem['menu_side_item_id'],
//'quantity' => $cartItem['quantity'],
//'comment' => $cartItem['comment'],
//];
    public function store(Request $request)
    {
        $order_id = $this->currentTableService->getOrderId();

        $order = Order::find($order_id);

        $order_round = $request->order_round;
        $order_item_id = $request->order_item_id;

        $order_items = [];

        // if table round is set, get all items from that round
        if ($order_round) {
            $order_items = $order->items()->where('table_round', $order_round)->get();
        }

        // if order item id is set, get that item
        if ($order_item_id) {
            $order_items = $order->items()->where('id', $order_item_id)->get();
        }

        // add each item to cart
        foreach ($order_items as $order_item) {
            $cartItem = [
                'menu_item_id' => $order_item->menu_item_id,
                'menu_side_item_id' => $order_item->menu_side_item_id,
                'quantity' => $order_item->quantity,
                'comment' => $order_item->comment,
            ];

            $this->cartService->add($cartItem);
        }

        return redirect()->route('tablets.cart.index')->with('success', 'Items added to cart');
    }
}
