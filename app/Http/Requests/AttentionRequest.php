<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttentionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'table_id' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
