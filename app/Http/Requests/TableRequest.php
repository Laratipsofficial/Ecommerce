<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
{
    public function rules()
    {
        return [
            'number' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
