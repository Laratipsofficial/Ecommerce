<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['nullable'],
            'phonenumber' => ['nullable'],
            'email' => ['nullable', 'email', 'max:254'],
            'age' => ['required', 'integer'],
            'reservation_id' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
