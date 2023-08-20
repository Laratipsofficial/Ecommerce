<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuSideItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'price' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
