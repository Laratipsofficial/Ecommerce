<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->whenNotNull($this->name),
            'slug' => $this->whenNotNull($this->slug),
            'created_at_formatted' => $this->when($this->created_at, function () {
                return $this->created_at->toDayDateTimeString();
            }),
            'active' => $this->whenNotNull($this->active),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'children_count' => $this->whenNotNull($this->children_count),
            'can' => [
                'edit' => $request->user()?->can('edit category'),
                'delete' => $request->user()?->can('delete category'),
            ],
        ];
    }
}
