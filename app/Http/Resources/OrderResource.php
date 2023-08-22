<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Orders\Order */
class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status_id' => $this->status_id,
            'type_id' => $this->type_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'total_price' => $this->total_price,
            'type' => new OrderTypeResource($this->whenLoaded('type')),
            'table' => new TableResource($this->whenLoaded('table')),
            'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'orderItemsCount' => $this->whenLoaded('orderItems', $this->items()->count()),
            'status' => new OrderStatusResource($this->whenLoaded('status')),
        ];
    }
}
