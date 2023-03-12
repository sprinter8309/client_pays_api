<?php

namespace App\Repositories;

use App\Models\Pay;
use App\Models\Dto\PayReportOptionsDto;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class PayRepository
{
    public function addPay(Pay $new_pay): bool
    {
        return $new_pay->save();
    }
    
    public function cancelPay(int $cancel_pay_id): bool
    {
        $pay_item = Pay::find($cancel_pay_id);
        $pay_item->is_cancelled = true;
        return $pay_item->save();        
    }
    
    public function getAllPays(PayReportOptionsDto $pay_report_options_dto): Collection
    {    
        $query = DB::table('pay')->join('client', fn ($join) =>
            $join->on('pay.client_id', '=', 'client.id') 
                 ->orOn('pay.client_phone', '=', 'client.phone')
        );
        
        if (!empty($pay_report_options_dto->client_id)) {
            $query = $query->where('pay.client_id', $pay_report_options_dto->client_id);
        }
                
        if (!empty($pay_report_options_dto->client_phone)) {
            $query = $query->where('pay.client_phone', $pay_report_options_dto->client_phone);
        }
            
        $query = $this->addBeginDateFilter($pay_report_options_dto, $query);
        
        $query = $this->addEndDateFilter($pay_report_options_dto, $query);
        
        $query = $query->select('pay.created_at as created_at', 'client.full_name as client', 'pay.sum as sum', 'pay.is_cancelled as action');
                
        return $query->get();
    }
    
    public function addBeginDateFilter(PayReportOptionsDto $pay_report_options_dto, Builder $current_query): Builder
    {
        if (!empty($pay_report_options_dto->begin_date)) {
                    
            $begin = $pay_report_options_dto->begin_date;
            
            if (!empty($pay_report_options_dto->begin_time)) {
                $begin .= ' ' . $pay_report_options_dto->begin_time;
            }
            
            return $current_query->where('pay.created_at', '>', $begin);
        }
        
        return $current_query;
    }
    
    public function addEndDateFilter(PayReportOptionsDto $pay_report_options_dto, Builder $current_query): Builder
    {
        if (!empty($pay_report_options_dto->end_date)) {
                    
            $end = $pay_report_options_dto->end_date;
            
            if (!empty($pay_report_options_dto->end_time)) {
                $end .= ' ' . $pay_report_options_dto->end_time;
            }
            
            return $current_query->where('pay.created_at', '<', $end);
        }
        
        return $current_query;
    }
}
