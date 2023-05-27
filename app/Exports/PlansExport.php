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

class PlansExport implements FromView, ShouldAutoSize
{
    use Exportable;
    private $file_name = 'Plans-Data.xlsx';
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {   
        $plan_data = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('plan_surveys','plan_surveys.plan_id','=','plans.id')
        ->where('plans.reason_deleted','=',0)
        ->where('users.type_account', '=', 'nhanvien')
        ->select(
            'plans.id as plan_id',
            'stores.region',
            'stores.distributor_code',
            'stores.distributor_name',
            'stores.asm_name',
            'stores.asm_phone',
            'stores.store_code_new',
            'stores.store_code',
            'stores.store_name',
            'stores.address',
            'stores.store_phone',
            'plans.lat',
            'plans.long',
            'plans.reason_id',
            'plans.note_admin',
            'users.username as user_name',
            'users.telephone as user_phone',
            'plans.date_start',
            'plans.date_end',
            'plans.plan_name',
            'plans.time_checkin',
            'plans.status as result',
            'plans.note_employee as staff_note',
            'plan_surveys.data_json'
        )
        ->orderBy('time_checkin','DESC')
        ->orderBy('date_start','DESC')
        ->orderBy('plan_id','DESC')
        ->get();
        $plan_export = array();
        
        $reasons_all = Reasons::all()->toArray();
        $reason_data = array();
        foreach($reasons_all as $reason){
            $reason_data[$reason['reason_id']] = $reason['reason_name'];
        }
        
        foreach($plan_data as $plan){
            $plan_staff_note = '';
            if(!empty($plan->staff_note)){
                $plan_staff_note = json_decode($plan->staff_note,true);
            }
            $data_jsondecode = json_decode($plan->data_json,1);
            $data1 = 0;
            $data2 = 0;
            $data3 = 0;
            $data4 = 0;
            if(!empty($data_jsondecode)){
                $data1 = (!empty($data_jsondecode[0]['survey_id']) && $data_jsondecode[0]['survey_id'] == 1)?$data_jsondecode[0]['value']:0;
                $data2 = (!empty($data_jsondecode[1]['survey_id']) && $data_jsondecode[1]['survey_id'] == 2)?$data_jsondecode[1]['value']:0;
                $data3 = (!empty($data_jsondecode[2]['survey_id']) && $data_jsondecode[2]['survey_id'] == 3)?$data_jsondecode[2]['value']:0;
                $data4 = (!empty($data_jsondecode[3]['survey_id']) && $data_jsondecode[3]['survey_id'] == 4)?$data_jsondecode[3]['value']:0;
            }
            $number_address = '';
            $street_address = '';
            $ward_address = '';
            $district_address = '';
            if(!empty($plan->address)){
                $store_address = explode(",",$plan->address);
                $number_address = !empty($store_address[0])?$store_address[0]:'';
                $street_address = !empty($store_address[1])?$store_address[1]:'';
                $ward_address = !empty($store_address[2])?$store_address[2]:'';
                $district_address = !empty($store_address[3])?$store_address[3]:'';
            }
            $date_checkin = '';
            $time_checkin = '';
            if(!empty($plan->time_checkin)){
                $date_checkin = date('Y-m-d',strtotime($plan->time_checkin));
                $time_checkin = date('H:i:s',strtotime($plan->time_checkin));
            }
            $reason_id = isset($plan->reason_id)?$plan->reason_id:0;
            $plan_export[] = array(
                'plan_id' => $plan->plan_id,
                'region' => $plan->region,
                'distributor_code' => $plan->distributor_code,
                'distributor_name' => $plan->distributor_name,
                'asm_name' => $plan->asm_name,
                'asm_phone' => $plan->asm_phone,
                'store_code_new' => $plan->store_code_new,
                'store_code' => $plan->store_code,
                'store_name' => $plan->store_name,
                'address' => $plan->address,
                'store_phone' => $plan->store_phone,
                'lat' => $plan->lat,
                'long' => $plan->long,
                'note_admin' =>  $plan->note_admin,
                'user_name' => $plan->user_name,
                'user_phone' => $plan->user_phone,
                'date_start' => $plan->date_start,
                'date_end' => $plan->date_end,
                'plan_name' => $plan->plan_name,
                'date_checkin' => $date_checkin,
                'time_checkin' => $time_checkin,
                'result' => $plan->result,
                'staff_note' => !empty($plan_staff_note['value'])?$plan_staff_note['value']:'',
                'number_address' => $number_address,
                'street_address' => $street_address,
                'ward_address' => $ward_address,
                'district_address' => $district_address,
                'reason_name' => isset($reason_data[$reason_id])?$reason_data[$reason_id]:'', 
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
                'data4' => $data4
            );
        }
        return view('exports.plans',[
            'plans' => $plan_export,
        ]);
    }
}
