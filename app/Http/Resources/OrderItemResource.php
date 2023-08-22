<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Orders\OrderItem */
class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'table_round' => $this->table_round,
            'order_id' => $this->order_id,
            'menu_item_id' => $this->menu_item_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'menu_side_item_id' => $this->menu_side_item_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'menu_item_name' => $this->menu_item_name,
            'menu_side_item_name' => $this->menu_side_item_name,
            'total_price' => $this->total_price,
            'comment' => $this->comment,
            'discount' => $this->discount,
            'menuItem' => new MenuItemResource($this->whenLoaded('menuItem')),
            'menuSideItem' => new MenuSideItemResource($this->whenLoaded('menuSideItem')),
        ];
    }
}
