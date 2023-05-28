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

    // For Mobile
    public function getPartiesByUserIdMobile(Request $request){
      if($request->user_id){ 
        $plan_parties = PlanParty::leftjoin('parties','parties.id','plan_party.party_id')
        ->leftjoin('users','users.id','plan_party.user_id')
        ->where('plan_party.user_id',$request->user_id)
        ->where('parties.organization_date','LIKE',date('Y-m').'%');
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
        'message' => 'Cập nhật trạng thái không thành công!',
      ]);
    }
  }
}
