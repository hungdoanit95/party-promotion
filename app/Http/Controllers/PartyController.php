<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parties;
use App\Models\PlanParty;
use App\Models\PlanImage;
use App\Models\PlanQc;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utils\Messages;
use Exception;
use Illuminate\Support\Facades\Storage;

class PartyController extends Controller
{
    private $keySearch = array(
        'party_code',
        'introducer_name',
        'introducer_phone',
        'party_host_name',
        'party_host_phone',
        'party_type',
        'party_level',
        'beer_type',
        'organization_date',
        'organization_time',
        'province',
        'district',
        'ward',
        'street',
        'home_number',
        'notes',
        'distributor',
        'point_of_salename',
        'point_of_salephone'
    );
    public function getParties(Request $request){
        $key_search = isset($request->key_search) ? rawurldecode($request->key_search) : '';
        if($key_search){
            $parties_data = Parties::where(function($query) use ($key_search){
                $query->where('party_code','LIKE','%'.$key_search.'%')
                ->orWhere('introducer_name','LIKE','%'.$key_search.'%')
                ->orWhere('introducer_phone','LIKE','%'.$key_search.'%')
                ->orWhere('party_host_name','LIKE','%'.$key_search.'%')
                ->orWhere('party_host_phone','LIKE','%'.$key_search.'%')
                ->orWhere('party_type','LIKE','%'.$key_search.'%')
                ->orWhere('party_level','LIKE','%'.$key_search.'%')
                ->orWhere('beer_type','LIKE','%'.$key_search.'%')
                ->orWhere('organization_date','LIKE','%'.$key_search.'%')   
                ->orWhere('organization_time','LIKE','%'.$key_search.'%')
                ->orWhere('province','LIKE','%'.$key_search.'%')
                ->orWhere('district','LIKE','%'.$key_search.'%')
                ->orWhere('ward','LIKE','%'.$key_search.'%')
                ->orWhere('street','LIKE','%'.$key_search.'%')
                ->orWhere('home_number','LIKE','%'.$key_search.'%')
                ->orWhere('notes','LIKE','%'.$key_search.'%')
                ->orWhere('distributor','LIKE','%'.$key_search.'%')
                ->orWhere('point_of_salename','LIKE','%'.$key_search.'%')
                ->orWhere('point_of_salephone','LIKE','%'.$key_search.'%')
                ->orWhere('user_id','LIKE','%'.$key_search.'%');
            })->where('status',1);
            $parties = $parties_data->orderByDesc('id')->paginate(50);
        }else{
            $parties = Parties::where('status', 1)->orderByDesc('id')->paginate(50);
        }
        return view('parties',[
            'parties_lists' => $parties,
            'key_search' => isset($request['key_search']) ? $request['key_search'] : ''
        ]);
    }

    public function getListPlansParty(Request $request){
        $key_search = isset($request->key_search) ? rawurldecode($request->key_search) : '';
        $plan_parties = PlanParty::leftjoin('parties','parties.id','plan_party.party_id')
        ->leftjoin('users','users.id','plan_party.user_id')
        ->whereNotNull('plan_party.id');
        if($key_search){
            foreach($this->keySearch as $keyword){
                $plan_parties = $plan_parties->orWhere($keyword,'LIKE','%'.$key_search.'%');
            }
        }
        $plan_parties = $plan_parties->select(
            'plan_party.*',
            'parties.*',
            'plan_party.id as plan_party_id',
            'users.id as user_id', 
            'users.username', 
            'users.telephone', 
            'users.type_account', 
            'users.group_id'
        );
        $plan_parties = $plan_parties->orderByDesc('plan_party.id')
        ->paginate(50)->appends(request()->query());
        $data_users = array();
        $route_plans = array();
        foreach($plan_parties as $plan){
            $data_users[$plan['user_id']] = array(
                'user_id' => $plan['user_id'],
                'username' => $plan['username'],
                'telephone' => $plan['telephone'],
                'group_id' => $plan['group_id'],
                'type_account' => $plan['type_account'],
            );
            $txt_route = date('Y-m',strtotime($plan['organization_date']));
            $route_plans[$txt_route] = $txt_route;
        }
        return view('list-plan-party',[
            'plan_parties' => $plan_parties,
            'params_search' => array(
                'user_id' => isset($request->user_id)?$request->user_id:'',
                'route_plan' => isset($request->route_plan)?$request->route_plan:''
            ),
            'users' => $data_users,
            'route_plans' => $route_plans
        ]);
    }



    
    // ===================================================================
    // ----------------------------- For Mobile--------------------------
    // =================================================================

    public function getPartiesByUserIdMobile(Request $request){
      if($request->user_id){ 
        $plan_parties = PlanParty::leftjoin('parties','parties.id','plan_party.party_id')
        ->leftjoin('users','users.id','plan_party.user_id')
        ->where('plan_party.user_id',$request->user_id);
        if(isset($request->type_view)&&$request->type_view == 'view-day'){
            $plan_parties = $plan_parties->where('parties.organization_date',date('Y-m-d'));
        }else if(isset($request->type_view)&&$request->type_view == 'view-month'){
            $plan_parties = $plan_parties->where('parties.organization_date','LIKE',date('Y-m').'%');
        }else{
            $plan_parties = $plan_parties->where('parties.organization_date','LIKE',date('Y-m').'%');
        }
        if(isset($request->status)){
            $plan_parties = $plan_parties->where('plan_party.status',$request->status);
        }
        $plan_parties = $plan_parties->select(
            'plan_party.*',
            'parties.*',
            'plan_party.id as plan_party_id',
            'users.id as user_id', 
            'users.username', 
            'users.telephone', 
            'users.type_account', 
            'users.group_id'
      );
      $plan_parties = $plan_parties->orderByDesc('plan_party.id')->get();
      return response()->json([
        'api_name' => 'List Plan Party',
        'status'  => 1,
        'data' => $plan_parties,
        'message' => 'Load dữ liệu thành công!',
      ]);
    }else{
      return response()->json([
        'api_name' => 'List Plan Party',
        'status'  => 0,
        'data' => '',
        'message' => 'Thiếu params user_id!',
      ]);
    }
  }
  
  public function checkinParty(Request $request){
    try{
        DB::enableQueryLog();
        $data = $request;
        if(empty($data['latitude'])||empty($data['longitude'])){
            return response()->json(
                [
                    'message' => Messages::MSG_0021,
                    'status' => 0
            ], 500);
        }
        if(empty($data['plan_party_id'])){
            return response()->json(
                [
                    'message' => Messages::MSG_0023,
                    'status' => 0
            ], 500);
        }

        $check_checkin = PlanParty::where('id', $data['plan_party_id'])
        ->where('user_id', $data['user_id'])->select('time_checkin','lat','long')->first();
        if(!empty($check_checkin->time_checkin) && !empty($check_checkin->lat)){
            return response()->json([
                'message' => 'Buổi tiệc đã check in vào lúc '.$check_checkin->time_checkin,
                'lat' => $check_checkin->lat,
                'long' => $check_checkin->long,
                'status' => 1
            ],200);
        }
        $check_update = PlanParty::where('id', $data['plan_party_id'])
        ->where('user_id', $data['user_id'])
        ->where('status',0)
        ->update([
            'ip_imei' => $data['imei'],
            'lat' => $data['latitude'],
            'long' => $data['longitude'],
            'time_checkin'=> date('Y-m-d H:i:s')
        ]);
        if($check_update){
            return response()->json([
                'message' => 'Bạn đã Check In thành công buổi tiệc!',
                'status' => 1
            ],200);
        }else{
            return response()->json([
                'message' => 'Check In không thành công vui lòng liên hệ IT',
                'status' => 0
            ],500);
        }
    }catch(Exception $e){
        return response()->json([
            'message' => 'Check In không thành công vui lòng liên hệ IT',
            'status' => 0,
            'log' => ''.$e
        ],500);
    }
  }
  public function getPlanPartyById(Request $request){
    if(!empty($request->plan_party_id)){
      $plan_datas = PlanParty::leftjoin('parties','parties.id','plan_party.party_id')
      ->where('plan_party.id', $request->plan_party_id)
      ->select(
        'parties.*',
        'plan_party.*',
        'plan_party.status as plan_party_status'
      )
      ->get();
      return response()->json([
          'api_name' => 'Plan Party API',
          'message' => 'Load dữ liệu thành công',
          'data' => $plan_datas,
          'status' => 1,
      ],200);
    }else{
      return response()->json([
          'api_name' => 'Plan Party API',
          'message' => 'Thiếu trường party id',
          'status' => 0,
      ],500);
    }
  }
  public function updatePlanCheckIn(Request $request){
    if(!empty($request->plan_party_id) && !empty($request->longitude) && !empty($request->latitude)){
      $time_checkin = date('Y-m-d H:i:s');
      $plan_datas = PlanParty::find($request->plan_party_id);
      $plan_datas->latitude = $request->latitude;
      $plan_datas->longitude = $request->longitude;
      $plan_datas->time_checkin = $time_checkin;
      $plan_datas->update();
      $message = "Bạn đã check in thành công \\n";
      $message .= "Thời gian: ".$time_checkin." /\n";
      $message .= "Toạ độ: ".$request->latitude ." - ".$request->longitude." \n";
      return response()->json([
          'api_name' => 'Plan check in API',
          'message' => $message,
          'status' => 1,
      ],200);
    }else{
      return response()->json([
          'api_name' => 'Plan Party API', 
          'message' => 'Thiếu params truyền vào',
          'status' => 0,
      ],500);
    }
  }

}
