<?php

namespace App\Models\Dto;

use App\Components\Dto\BaseDto;

class CreateClientDto extends BaseDto
{
    public string $phone;
    
    public string $full_name;
    
    public ?int $balance;
    
    public string $status;
    
    public ?string $email;       
        
    public ?int $age;
}
