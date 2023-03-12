<?php

namespace App\Models\Dto;

use App\Components\Dto\BaseDto;

class CreatePayDto extends BaseDto
{
    public int $sum;
    
    public ?string $client_id;
    
    public ?string $client_phone;
}
