<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Components\Enums\ClientStatusType;
use App\Models\Dto\ChangeClientStatusDto;
use App\Models\Client;

class ClientRepository
{
    public function getClientList(): Collection
    {
        return Client::select(['id', 'phone', 'full_name', 'balance', 'status'])
                        ->where('status', ClientStatusType::Active)
                        ->get();
    }
    
    public function createClient(Client $new_client): bool
    {
        return $new_client->save();
    }
    
    public function changeClientStatus(ChangeClientStatusDto $change_client_status_dto): bool
    {
        $client_record = Client::findOrFail($change_client_status_dto->client_id);
        $client_record->status = $change_client_status_dto->status;
        return $client_record->save();     
    }
    
    public function isClientBlocked(?string $client_id, ?string $client_phone): bool
    {               
        if (!empty($client_id)) {
            $client = Client::findOrFail($client_id);  
            
            if ($client->status === ClientStatusType::Active->stringName()) {          
                return false;
            }
        }
        
        if (!empty($client_phone)) {
            $client = Client::where('phone', $client_phone)->first();  
            if ($client->status === ClientStatusType::Active->stringName()) {          
                return false;
            }
        }
        
        return true;
    }
    
    public function getClientById(string $client_id): ?Client
    {
        return Client::find($client_id);
    }
    
    public function getClientByPhone(string $client_phone): ?Client
    {
        return Client::select()->where('phone', $client_phone)->first();
    }    
}
