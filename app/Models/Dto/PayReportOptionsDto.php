<?php

namespace App\Models\Dto;

use App\Components\Dto\BaseDto;

class PayReportOptionsDto extends BaseDto
{
    public ?string $client_id;
    
    public ?string $client_phone;
    
    public ?string $begin_date;
    
    public ?string $end_date;
    
    public ?string $begin_time;
    
    public ?string $end_time;
}
