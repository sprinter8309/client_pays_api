<?php

namespace App\Services;

use App\Factories\ClientFactory;
use App\Repositories\ClientRepository;
use App\Models\Dto\CreateClientDto;
use App\Models\Dto\ChangeClientStatusDto;

class ClientService
{       
    public function __construct(protected ClientRepository $client_repository, 
                                protected ClientFactory $client_factory)
    {
        $this->client_repository = $client_repository;
        $this->client_factory = $client_factory;
    }
    
    public function getClientList(): array
    {
        return $this->client_repository->getClientList()->toArray();
    }
    
    public function createClient(CreateClientDto $create_client_dto): bool
    {              
        $new_client = $this->client_factory->createClient($create_client_dto);        
        return $this->client_repository->createClient($new_client);               
    }
    
    public function changeClientStatus(ChangeClientStatusDto $change_client_status_dto): bool
    {
        return $this->client_repository->changeClientStatus($change_client_status_dto);
    }
    
    public function isClientBlocked(?string $client_id, ?string $client_phone): bool
    {
        return $this->client_repository->isClientBlocked($client_id, $client_phone);
    }
    
    public function checkIdentificationData(?string $client_id, ?string $client_phone)
    {        
        if (!empty($client_id) && !empty($client_phone)) {
            return false;
        }
        
        if (empty($client_id) && empty($client_phone)) {
            return false;
        }
        
        if (!empty($client_id)) {            
            if (empty($this->client_repository->getClientById($client_id))) {                
                return false;
            }
        }
        
        if (!empty($client_phone)) {
            if (empty($this->client_repository->getClientByPhone($client_phone))) {
                return false;
            }
        }
        
        return true;
    }
}
