<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Pay\AddPayRequest;
use App\Http\Requests\Pay\CancelPayRequest;
use App\Http\Controllers\Controller;
use App\Services\PayService;
use App\Models\Dto\CreatePayDto;
use App\Models\Dto\PayReportOptionsDto;
use App\Constants\DisplayConst;

class PayController extends Controller
{
    public function __construct(protected PayService $pay_service)
    {
        $this->pay_service = $pay_service;
    }
    
    public function addPay(AddPayRequest $request)
    {
        $this->pay_service->addPay(CreatePayDto::loadFromArray($request->all()));
        return response()->json(['message'=>DisplayConst::SUCCESSFULL_ADD_PAY_MESSAGE]);
    }
    
    public function cancelPay(CancelPayRequest $request)
    {
        $this->pay_service->cancelPay($request->input('cancel_pay_id', ''));
        return response()->json(['message'=>DisplayConst::SUCCESSFULL_CANCEL_PAY_MESSAGE]);
    }
    
    public function paysReportShow(Request $request)
    {
        return response()->json($this->pay_service->getPaysReport(PayReportOptionsDto::loadFromArray($request->all())));
    }
}
