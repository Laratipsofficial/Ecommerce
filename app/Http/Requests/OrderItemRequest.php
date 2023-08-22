<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'table_round' => ['nullable', 'integer'],
            'menu_item_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
            'menu_side_item_id' => ['nullable', 'integer'],
            'comment' => 'nullable|string',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
