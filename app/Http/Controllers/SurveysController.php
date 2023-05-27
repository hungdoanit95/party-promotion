<?php

namespace App\Http\Controllers;

use App\Models\PlanSurvey;
use App\Models\SurveyHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SurveysController extends Controller
{
    public function index(){
        try{
            DB::enableQueryLog();
            $route_plan = date('Y-m');
            $surveys = SurveyHistory::where('route_plan',$route_plan)->get();
            return response()->json([
                'api_name' => 'Survey List API',
                'data' => $surveys,
                'status' => 1
            ],200);
        }catch(Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Lỗi surveys api',
                'log' => ''.$e
            ],500);
        }
    }
    public function get_data_survey(Request $request){
        if(empty($request['plan_id'])){
            return response()->json([
                'api_name' => 'Data Survey API',
                'status' => 0,
                'message' => 'Lỗi surveys api'
            ],500);
        }
        $plan_id = $request['plan_id'];
        $plan_survey = PlanSurvey::where('plan_id', $plan_id)
        ->where('user_id', $request['user_id'])
        ->select('data_json')->first();
        return response()->json([
            'api_name' => 'Data Survey API',
            'data' => !empty($plan_survey->data_json)?$plan_survey->data_json:'',
            'status' => 1
        ],200);
    }
}
