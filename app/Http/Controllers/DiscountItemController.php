<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountItemRequest;
use App\Http\Resources\DiscountItemResource;
use App\Models\Discount\DiscountItem;

class DiscountItemController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', DiscountItem::class);

        return DiscountItemResource::collection(DiscountItem::all());
    }

    public function store(DiscountItemRequest $request)
    {
        $this->authorize('create', DiscountItem::class);

        return new DiscountItemResource(DiscountItem::create($request->validated()));
    }

    public function show(DiscountItem $discountItem)
    {
        $this->authorize('view', $discountItem);

        return new DiscountItemResource($discountItem);
    }

    public function update(DiscountItemRequest $request, DiscountItem $discountItem)
    {
        $this->authorize('update', $discountItem);

        $discountItem->update($request->validated());

        return new DiscountItemResource($discountItem);
    }

    public function destroy(DiscountItem $discountItem)
    {
        $this->authorize('delete', $discountItem);

        $discountItem->delete();

        return response()->json();
    }
}
