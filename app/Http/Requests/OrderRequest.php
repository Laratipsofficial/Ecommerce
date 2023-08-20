<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status_id' => ['nullable'],
            'type_id' => ['nullable'],
            'price' => ['nullable'],
            'discount' => ['required'],
            'comment' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
