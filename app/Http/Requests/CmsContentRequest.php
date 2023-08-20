<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsContentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'seoTitle' => ['required'],
            'seoDescription' => ['required'],
            'displayName' => ['required'],
            'slug' => ['required'],
            'content' => ['required'],
            'culture' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
