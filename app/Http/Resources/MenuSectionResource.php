<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Menu\MenuSection */
class MenuSectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'menu_items' => MenuItemResource::collection($this->menuItems),
        ];
    }
}
