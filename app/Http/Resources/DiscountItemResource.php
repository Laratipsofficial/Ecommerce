<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Discount\DiscountItem */
class DiscountItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'discount' => $this->discount,
            'discount_id' => $this->discount_id,
            'menu_item_id' => $this->menu_item_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'menu_item' => MenuItemResource::collection($this->whenLoaded('menuItem')),
            'menu_item_name' => $this->getMenuItemNameAttribute(),
            'is_active' => $this->getIsActiveAttribute(),
            'menu_item_price' => $this->getDiscountedPriceAttribute(),
        ];
    }
}
