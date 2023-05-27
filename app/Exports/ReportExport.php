<?php

namespace App\Exports;

use App\Models\Plan;
use App\Models\Reasons;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $file_name = 'Report-Plan-Data.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */

    private $params = array();

    public function __construct($params){
        $this->params = $params;
    }

    // public function collection()
    public function view(): View
    {
        $params = $this->params;
        $query = DB::table('plans')->leftjoin('stores', 'stores.id', 'plans.store_id')
        ->leftjoin('plan_surveys', 'plan_surveys.plan_id', 'plans.id')
        ->leftJoin('plan_qc', function($subquery){
            $subquery->on('plan_qc.plan_id', '=', 'plans.id');
        })
        ->leftJoin('users', 'users.id', 'plans.user_id')
        ->leftjoin('reasons', 'reasons.reason_id','=', 'plans.reason_id');
        if(isset($params['status']) && $params['status'] !== '*'){
            $query->where('plans.status',$params['status']);
        }
        if(!empty($params['user_id']) && $params['user_id'] !== '*'){
            $query->where('plans.user_id',$params['user_id']);
        }
        if(isset($params['plan_qc']) && $params['plan_qc'] !== '*'){
            if($params['plan_qc'] == 1){
                $query->whereNull('plan_qc.user_id');
            }else if($params['plan_qc'] == 2){
                $query->whereNotNull('plan_qc.user_id');
            }
        }
        if(!empty($params['plan_name']) && $params['plan_name'] !== '*'){
            $query->where('plan_name',$params['plan_name']);
        }
        if(!empty($params['start_date']) && $params['start_date'] !== '*'){
            $query->where('date_start','>=',$params['start_date']);
        }
        if(!empty($params['end_date']) && $params['end_date'] !== '*'){
            $query->where('date_end','<=',$params['end_date']);
        }
        if(!empty($params['route_plan'])){
            $query->where('plans.route_plan',$params['route_plan']);
        }
        $query->whereNotIn('users.telephone',array('0909123456'));
        $query->select(
            'plan_qc.user_id as user_qc_id',
            'plan_qc.group_id as user_group_qc',
            'plan_surveys.result as status_result',
            'plan_surveys.data_json as data_json',
            'users.username as user_name',
            'users.telephone as user_phone',
            'plans.*',
            'plans.status as plan_status',
            'plans.id as plan_id',
            'reason_name',
            // 'stores.store_code as store_code',
            // 'stores.store_name as store_name',
            // 'stores.store_name_new as store_name_new',
            // 'stores.store_phone as store_phone',
            // 'stores.address as address',
            // 'stores.address_new as address_new',
            // 'stores.asm_name as asm_name',
            // 'stores.asm_phone as asm_phone',
            'stores.*',
            'stores.id as store_id'
        );
        $data_plans = $query->get()->toArray();
        $export_data = array();
        foreach($data_plans as $plan){
            $detail_address = !empty($plan->address_new)?explode(',',$plan->address_new):explode(',',$plan->address);
            $data_json = !empty($plan->data_json)?json_decode($plan->data_json,true):array();
            $plan->number_address = isset($detail_address[0])?$detail_address[0]:'';
            $plan->street_address = '';
            $plan->ward_address = (isset($detail_address[4]) && isset($detail_address[2]))?$detail_address[2]:(isset($detail_address[1])?$detail_address[1]:'');
            $plan->district_address = (isset($detail_address[3])&&isset($detail_address[4]))?$detail_address[3]:(isset($detail_address[2])?$detail_address[2]:''); 
            $plan->province_address = isset($detail_address[4])?$detail_address[4]:(isset($detail_address[3])?$detail_address[3]:''); 
            $plan->date_checkin = isset($plan->time_checkin)?date('Y-m-d', strtotime($plan->time_checkin)) : '';
            $plan->time_checkin = isset($plan->time_checkin)?date('H:i:s', strtotime($plan->time_checkin)) : '';
            $plan->staff_note = (str_contains($plan->note_employee, '{"value"'))?json_decode($plan->note_employee,true)['value']:$plan->note_employee;
            foreach($data_json as $dt){
                $plan->data_survey[$dt['survey_id']] = isset($dt['value'])?$dt['value']:'';
            }
            $export_data[] = $plan;
        }
        return view('exports.report',[
            'data_plans' => $export_data
        ]);
    }
}