<?php

namespace App\Http\Requests\Tablets\Menus;

use Illuminate\Foundation\Http\FormRequest;

class TabletMenuRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1',
            'menu_side_item_id' => 'nullable|exists:menu_side_items,id',
            'comment' => 'nullable|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
