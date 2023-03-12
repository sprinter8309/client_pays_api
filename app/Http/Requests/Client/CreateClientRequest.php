<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Components\Enums\ClientStatusType;

class CreateClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone'=>'required|min:5|string|unique:client,phone',
            'full_name'=>'required|min:2|string',
            'balance'=>'decimal:2',
            'status'=>[new Enum(ClientStatusType::class)],
        ];
    }
}
