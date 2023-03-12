<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Components\Enums\ClientStatusType;

class ChangeClientStatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'client_id'=>'required|integer|exists:client,id',
            'status'=>[new Enum(ClientStatusType::class)],
        ];
    }
}
