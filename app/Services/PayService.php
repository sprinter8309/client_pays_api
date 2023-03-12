<?php

namespace App\Services;

use App\Services\ClientService;
use App\Repositories\PayRepository;
use App\Factories\PayFactory;
use App\Models\Dto\CreatePayDto;
use App\Models\Dto\PayReportOptionsDto;
use App\Constants\DisplayConst;
use Illuminate\Support\Collection;

class PayService
{   
    public function __construct(protected PayRepository $pay_repository, 
                                protected PayFactory $pay_factory,
                                protected ClientService $client_service)
    {
        $this->client_service = $client_service;
        $this->pay_repository = $pay_repository;
        $this->pay_factory = $pay_factory;
    }
    
    public function addPay(CreatePayDto $create_pay_dto)
    {    
        if (!$this->client_service->checkIdentificationData($create_pay_dto->client_id, $create_pay_dto->client_phone)) {
            throw new \Exception(DisplayConst::CLIENT_IDENTIFICATION_DATA_ERROR);
        }

        if ($this->client_service->isClientBlocked($create_pay_dto->client_id, $create_pay_dto->client_phone)) {
            throw new \Exception(DisplayConst::PAY_FROM_BLOCKED_CLIENT_ERROR);
        }
        
        $new_pay = $this->pay_factory->createPay($create_pay_dto);        
        return $this->pay_repository->addPay($new_pay);
    }
    
    public function cancelPay(int $cancel_pay_id)
    {
        return $this->pay_repository->cancelPay($cancel_pay_id);
    }
    
    public function getPaysReport(PayReportOptionsDto $pay_report_options_dto)
    {      
        if (!empty($pay_report_options_dto->client_id) && !empty($pay_report_options_dto->client_phone)) {
            throw new \Exception(DisplayConst::REPORT_IDENTIFICATION_BOTH_FILTERS_ERROR);
        }
        
        $pay_set = $this->pay_repository->getAllPays($pay_report_options_dto);        
        
        $total_sum = $this->getTotalPaySetSum($pay_set);
        
        $prepared_pay_set = $this->paySetActionLabelModify($pay_set);
        
        return [
            'paySet' => $prepared_pay_set->toArray(),
            'totalSum' => $total_sum
        ];
    }
    
    public function paySetActionLabelModify(Collection $pay_set): Collection
    {
        return $pay_set->map(function ($item) {
            $item->action = ($item->action == false) ? DisplayConst::TYPICAL_PAY_ACTION : DisplayConst::CANCEL_PAY_ACTION;
            return $item;
        });
    }
    
    public function getTotalPaySetSum(Collection $pay_set): float
    {
        $totalSum = 0.0;
        
        foreach ($pay_set as $pay) {

            if ($pay->action == false) {               
                $totalSum += (float)$pay->sum;
            }
        }
        
        return $totalSum;
    }
}
