<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Discount::class);

        return DiscountResource::collection(Discount::all());
    }

    public function store(DiscountRequest $request)
    {
        $this->authorize('create', Discount::class);

        return new DiscountResource(Discount::create($request->validated()));
    }

    public function show(Discount $discount)
    {
        $this->authorize('view', $discount);

        return new DiscountResource($discount);
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        $this->authorize('update', $discount);

        $discount->update($request->validated());

        return new DiscountResource($discount);
    }

    public function destroy(Discount $discount)
    {
        $this->authorize('delete', $discount);

        $discount->delete();

        return response()->json();
    }
}
