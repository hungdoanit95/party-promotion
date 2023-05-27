<?php

namespace App\Http\Controllers;

use App\Models\CameraType;
use App\Models\CodeQcs;
use App\Models\Plan;
use App\Models\PlanImage;
use App\Models\PlanNote;
use App\Models\PlanQc;
use App\Models\PlanQcCode;
use App\Models\PlanSurvey;
use App\Models\Reasons;
use App\Models\Store;
use App\Models\SurveyHistory;
use App\Models\SurveyQuestion;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utils\Messages;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;

class MapController extends Controller
{
    public function index(Request $request){
        $data_map = Plan::leftjoin('stores','stores.id','plans.store_id')->where('plans.id_deleted',0)
        ->select('plans.status as plan_status','plans.id as plan_id','plans.lat as plan_lat','plans.long as plan_long', 'stores.lat as store_lat', 'stores.long as store_long', 'stores.store_name','stores.address','stores.store_phone','stores.overview_img')
        ->get();
        return view('map',[
            'message' => 'Data Location',
            'status' => 1,
            'data_map' => json_encode($data_map),
            'total_data' => count($data_map)
        ]);
    }
}