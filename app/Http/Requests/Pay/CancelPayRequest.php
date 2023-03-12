<?php

namespace App\Http\Requests\Pay;

use Illuminate\Foundation\Http\FormRequest;

class CancelPayRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cancel_pay_id'=>'required|integer|exists:pay,id',
        ];
    }
}
