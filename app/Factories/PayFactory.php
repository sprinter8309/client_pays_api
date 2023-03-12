<?php

namespace App\Factories;

use App\Models\Pay;
use App\Models\Dto\CreatePayDto;

class PayFactory
{
    public function createPay(CreatePayDto $create_pay_dto): Pay
    {
        $new_pay = new Pay();
        
        $new_pay->sum = $create_pay_dto->sum;
        $new_pay->client_id = $create_pay_dto->client_id ?? null;
        $new_pay->client_phone = $create_pay_dto->client_phone ?? null;
        $new_pay->is_cancelled = false;
        
        return $new_pay;
    }
}
