<?php

namespace App\Models\Dto;

use App\Components\Dto\BaseDto;

class ChangeClientStatusDto extends BaseDto
{
    public string $client_id;
    
    public string $status;
}
