<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'discount' => ['required', 'numeric','min:0'],
            'menu_item_id' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
