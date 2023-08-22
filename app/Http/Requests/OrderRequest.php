<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status_id' => ['required'],
            'type_id' => ['required'],
            'table_id' => ['nullable'],
            'comment' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
