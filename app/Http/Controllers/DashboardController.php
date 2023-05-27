<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanQc;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user_info = session()->get('user.info');
        if(empty($user_info)){
            return redirect()->route('login.page');
        }
        $route_plan = isset($request->route_name)?$request->route_name:'';
        $start_date = isset($request->start_date)?$request->start_date:'';
        $end_date = isset($request->end_date)?$request->end_date:'';
        $val_province = isset($request->val_province) && $request->val_province != '*'?$request->val_province:'';
        $all_plan = Plan::leftjoin('stores','stores.id','plans.store_id')->whereNotNull('plans.id')->where('plans.id_deleted',0);
        if(!empty($route_plan)){
            $all_plan->where('plans.route_plan', $route_plan);
        }
        if(!empty($start_date)){
            $all_plan->where('plans.date_start', '>=', $start_date);
        }
        if(!empty($end_date)){
            $all_plan->where('plans.date_end', '<=', $end_date);
        }
        if(!empty($val_province) && $val_province != '*'){
            $all_plan->where('stores.city_name','like','%'.$val_province.'%');
        }
        $all_plan = $all_plan->count();
        $all_plan_doing = Plan::leftjoin('stores','stores.id','plans.store_id')->whereNotNull('plans.id')->where('plans.id_deleted',0);
        if(!empty($route_plan)){
            $all_plan_doing->where('plans.route_plan', $route_plan);
        }
        if(!empty($start_date)){
            $all_plan_doing->where('plans.date_start', '>=', $start_date);
        }
        if(!empty($end_date)){
            $all_plan_doing->where('plans.date_end', '<=', $end_date);
        }
        if(!empty($val_province)){
            $all_plan_doing->where('stores.city_name','like','%'.$val_province.'%');
        }
        $all_plan_doing = $all_plan_doing->whereIn('plans.status', array(1,2))->count();
        $all_plan_not_make = $all_plan - $all_plan_doing;
        $users = User::all()->where('group_id', '=', 10);
        $plans = Plan::leftjoin('stores','stores.id','plans.store_id')->whereNotNull('plans.id')->where('plans.id_deleted',0);
        if(!empty($route_plan)){
            $plans->where('plans.route_plan', $route_plan);
        }
        if(!empty($start_date)){
            $plans->where('plans.date_start', '>=', $start_date);
        }
        if(!empty($end_date)){
            $plans->where('plans.date_end', '<=', $end_date);
        }
        if(!empty($val_province)){
            $plans->where('stores.city_name','like','%'.$val_province.'%');
        }
        $plans = $plans->select('plans.*','stores.store_name','stores.address')->get();

        $plan_by_users = array();
        foreach($plans as $plan){
            $plan_by_users[$plan['user_id']][] = $plan;
        }
        $data_users = array();
        $data_map = array();
        $status_tc_tt = 0;
        $province_filter = array();
        foreach ($users as $user) {
            $data_plan = !empty($plan_by_users[$user['id']])?$plan_by_users[$user['id']]:'';
            $status_notdoing = 0;
            $status_tc = 0;
            $status_ktc = 0;
            $checkin_today = 0;
            if(!empty($data_plan)){
                foreach($data_plan as $data){
                    if($data['status'] == 0){
                        $status_notdoing += 1;
                    }
                    if($data['status'] == 1){
                        $status_tc += 1;
                    }
                    if($data['status'] == 2){
                        $status_ktc += 1;
                    }
                    if($data['time_checkin'] != '1970-01-01' && date('Y-m-d', strtotime($data['time_checkin'])) == date('Y-m-d')){
                        $checkin_today += 1;
                    }
                }
            }
            $total_plan_user = $status_notdoing + $status_tc + $status_ktc;
            $progress = $status_tc + $status_ktc;
            $percent_progress = ($total_plan_user > 0) ? ($status_tc + $status_ktc) / $total_plan_user : 0;
            $plan_qcs = DB::table('plan_qc')->leftjoin('plans','plans.id','plan_qc.plan_id')->whereMonth('date_start', date('m'))
            ->where('plans.status','!=',0)
            ->whereYear('date_start', date('Y'))->select([
                'plans.id as plan_id',
                'plans.user_id as user_id',
                'plan_qc.id as plan_qc_id'
            ])->get();
            $data_qc_dt = array();
            foreach($plan_qcs as $pl){
                $data_qc_dt[$pl->user_id][$pl->plan_id][] = $pl;
            }
            $data_map['name_user'][] = $user['username'];
            $data_users[$user['id']] = array(
                'id' => $user['id'],
                'user_name' => $user['username'],
                'region_name' => $user['region_name'],
                'status_notdoing' => $status_notdoing,
                'total' => $total_plan_user,
                'progress' => $progress,
                'percent_progress' => ($total_plan_user > 0) ?floor($progress / $total_plan_user * 100) . '%': '0%',
                'status_tc' => $status_tc,
                'status_ktc' => $status_ktc,
                'checkin_today' => $checkin_today,
                'total_data_qc' => isset($data_qc_dt[$user['id']])?count($data_qc_dt[$user['id']]):0
            );
            $percent_making = ($all_plan > 0)?(($all_plan_doing / $all_plan) * 100): '0%';
            $percent_notmake = ($all_plan > 0)?(($all_plan_not_make / $all_plan) * 100): '0%';
            $statistical = array(
                'all_plan' => $all_plan,
                'plan_making' => $all_plan_doing,
                'percent_making' => round($percent_making, 1).'%',
                'percent_notmake' => round($percent_notmake, 1).'%',
                'plan_not_made' => $all_plan_not_make
            );
            $status_tc_tt += $status_tc;
            if(!empty($user['region_name'])){
                $province_filter[$user['region_name']] = $user['region_name'];
            }
        }
        $statistical_map = array(
            [
                'name' => 'Đã làm',
                'value' => $all_plan_doing 
            ],
            [
                'name' => 'Chưa làm',
                'value' => $all_plan_not_make 
            ]
        );
        $statistical_success = array(
            [
                'name' => 'Thành công',
                'value' => $status_tc_tt
            ],
            [
                'name' => 'Không thành công',
                'value' => ($all_plan_doing - $status_tc_tt)
            ],
            [
                'name' => 'Chưa làm',
                'value' => $all_plan_not_make
            ]
        );
        $route_plans = Plan::where('id_deleted',0)->groupBy('route_plan')->select('route_plan')->get();
        return view('dashboard',[
            'user_info'=>$user_info,
            'data_users' => $data_users,
            'data_map'=>$data_map, 
            'statistical' => $statistical,
            'statistical_map' => json_encode($statistical_map),
            'statistical_success_map' => json_encode($statistical_success),
            'all_plan' => $all_plan,
            'users' => $users,
            'province_filter' => $province_filter,
            'params_search' => [
                'route_plan' => $route_plan,
                'start_date' => $start_date,
                'end_date' => $end_date
            ], 
            'route_plans' => $route_plans
        ]);
    }
}
