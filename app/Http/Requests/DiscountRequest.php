<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'starts_at' => ['required'],
            'ends_at' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
