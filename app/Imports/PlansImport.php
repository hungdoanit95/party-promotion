<?php

namespace App\Imports;

use App\Models\Plan;
use App\Models\Store;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PlansImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        if(!empty($row[1]) && !empty($row[3])){
            $id_user = User::where('telephone', '=', trim($row[3]))->first();
            $id_store = Store::where('store_code','=',trim($row[1]))->first();
            $plan_name = isset($row[6])?$row[6]:null;
            // if($plan_name !== null && !empty($id_store->id) && !empty($id_user->id)){
            //     $check_plan = Plan::where('plan_name',trim($row[6]))->where('user_id', $id_user->id)->where('store_id',$id_store->id)->first();
            //     if($check_plan){
            //         Plan::where('plan_name',trim($row[6]))->where('user_id', $id_user->id)->where('store_id',$id_store->id)->update(
            //             [
            //                 'store_id'=>$id_store->id,
            //                 'user_id'=>$id_user->id,
            //                 'route_plan'=>date('Y-m', strtotime($row[4])),
            //                 'date_start'=>date('Y-m-d', strtotime($row[4])),
            //                 'date_end'=>date('Y-m-d', strtotime($row[5])),
            //                 'plan_name'=>$row[6],
            //                 'note_admin'=>isset($row[7])?$row[7]:'',
            //                 'created_at'=>date('Y-m-d H:i:s')
            //             ]
            //         );
            //     }
            //     Plan::createOrUpdate(
            //         [
            //             'store_id'=>$id_store->id,
            //             'user_id'=>$id_user->id,
            //             'route_plan'=>date('Y-m', strtotime($row[4])),
            //             'date_start'=>date('Y-m-d', strtotime($row[4])),
            //             'date_end'=>date('Y-m-d', strtotime($row[5])),
            //             'plan_name'=>$row[6],
            //             'note_admin'=>isset($row[7])?$row[7]:'',
            //             'created_at'=>date('Y-m-d H:i:s')
            //         ]
            //     );
            // }else if($plan_name === null && !empty($id_store->id) && !empty($id_user->id)){
                return new Plan([
                    'store_id'=>$id_store->id,
                    'user_id'=>$id_user->id,
                    'route_plan'=>date('Y-m', strtotime($row[4])),
                    'date_start'=>date('Y-m-d', strtotime($row[4])),
                    'date_end'=>date('Y-m-d', strtotime($row[5])),
                    'plan_name'=>isset($row[6])?$row[6]:'',
                    'note_admin'=>isset($row[7])?$row[7]:'',
                    'created_at'=>date('Y-m-d H:i:s')
                ]);
            // }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
