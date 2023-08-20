<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Models\Orders\OrderItem;

class OrderItemController extends Controller
{
    public function index()
    {
        return OrderItemResource::collection(OrderItem::all());
    }

    public function store(OrderItemRequest $request)
    {
        return new OrderItemResource(OrderItem::create($request->validated()));
    }

    public function show(OrderItem $orderItem)
    {
        return new OrderItemResource($orderItem);
    }

    public function update(OrderItemRequest $request, OrderItem $orderItem)
    {
        $orderItem->update($request->validated());

        return new OrderItemResource($orderItem);
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return response()->json();
    }
}
