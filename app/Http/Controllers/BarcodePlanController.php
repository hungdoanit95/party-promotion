<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarcodePlan;

class BarcodePlanController extends Controller
{
    public function getBarcodeByPlanId(Request $request){
        if(!empty($request->plan_id)){
           $barcodePlan = BarcodePlan::where('plan_id',$request->plan_id)->get();
           return $barcodePlan;
        }else{
            echo 'Không nhận được params plan Id';
        }
    }
    public function updateBarcodePlan(Request $request){
        
    }
}
