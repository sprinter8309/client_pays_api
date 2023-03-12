<?php

namespace App\Factories;

use App\Models\Client;
use App\Models\Dto\CreateClientDto;

class ClientFactory
{
    public function createClient(CreateClientDto $create_client_dto): Client
    {
        $new_client = new Client();
        
        $new_client->phone = $create_client_dto->phone;
        $new_client->full_name = $create_client_dto->full_name;
        $new_client->balance = $create_client_dto->balance;
        $new_client->status = $create_client_dto->status;
        
        return $new_client;
    }
}
