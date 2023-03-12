<?php

namespace App\Components\Enums;

enum ClientStatusType: string
{
    case Active = 'active';
    
    case Blocked = 'blocked';
    
    public function stringName(): string
    {
        return match($this) {
            ClientStatusType::Active => 'active',
            ClientStatusType::Blocked => 'blocked'
        };
    }
}
