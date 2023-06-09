<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarcodePlan;
use App\Models\PlanParty;

class BarcodePlanController extends Controller
{
    public function getBarcodeByPlanId(Request $request){
        if(!empty($request->plan_party_id)){
           $barcodePlan = BarcodePlan::where('plan_id',$request->plan_party_id)->get();
           return $barcodePlan;
        }else{
            echo 'Không nhận được params plan Id';
        }
    }
    public function updateBarcodePlan(Request $request){
        if(!empty($request->plan_party_id)){
            BarcodePlan::updateOrCreate(['plan_id' => $request->plan_party_id],[
                'barcode_presenter' => $request->barcode_presenter,
                'barcode_owner' => $request->barcode_owner,
                'plan_id' => $request->plan_party_id,
                'level' => $request->level
            ]);
            PlanParty::where('id', $request->plan_party_id)->update([
                'check_barcode' => 1
            ]);
            return response()->json(
                [
                    'api_name'=> 'API Update Barcode Plan',
                    'message' => 'Update dữ liệu thành công!',
                    'status' => 1
            ], 200);
        }else{
            return response()->json(
                [
                    'api_name'=> 'API Update Barcode Plan',
                    'message' => 'Thiếu params truyền vào!',
                    'status' => 0
            ], 200);
        }
    }
}
