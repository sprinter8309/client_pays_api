<?php

namespace App\Http\Requests\Pay;

use Illuminate\Foundation\Http\FormRequest;

class AddPayRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sum'=>'decimal:2'
        ];
    }
}
