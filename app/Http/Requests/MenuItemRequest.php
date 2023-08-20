<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'number' => ['nullable', 'integer'],
            'number_addition' => ['nullable'],
            'price' => ['required'],
            'menu_section_id' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
