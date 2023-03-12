<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\ChangeClientStatusRequest;
use App\Http\Controllers\Controller;
use App\Services\ClientService;
use App\Models\Dto\CreateClientDto;
use App\Models\Dto\ChangeClientStatusDto;
use App\Constants\DisplayConst;

class ClientController extends Controller
{
    public function __construct(protected ClientService $client_service)
    {
        $this->client_service = $client_service;
    }
    
    public function clientList()
    {
        return response()->json($this->client_service->getClientList());
    }
    
    public function createClient(CreateClientRequest $request)
    {        
        $this->client_service->createClient(CreateClientDto::loadFromArray($request->all()));
        return response()->json(['message'=>DisplayConst::SUCCESSFULL_CREATE_CLIENT_MESSAGE]);
    }
    
    public function changeClientStatus(ChangeClientStatusRequest $request)
    {
        $this->client_service->changeClientStatus(ChangeClientStatusDto::loadFromArray($request->all()));
        return response()->json(['message'=>DisplayConst::SUCCESSFULL_CHANGE_CLIENT_STATUS_MESSAGE]);
    }
}
