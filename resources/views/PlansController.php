<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanImage;
use App\Models\PlanSurvey;
use App\Models\Reasons;
use App\Models\Store;
use App\Models\SurveyHistory;
use App\Models\SurveyQuestion;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utils\Messages;
use Exception;
use Illuminate\Support\Facades\Storage;

class PlansController extends Controller
{
    public function index(Request $request){
        try{
            $query_data = $request;
            DB::enableQueryLog();
            $user_id = $query_data['user_id'];
            $total_plan = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->where('plans.date_end', '>=', date('Y-m-d'))
            ->where('plans.reason_deleted','=',0)
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            $total_plan_making = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->whereNotNull('plans.time_checkin')
            ->where('plans.date_end', '>=', date('Y-m-d'))
            ->where('plans.status','=',0)
            ->where('plans.reason_deleted','=',0)
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            $total_plan_unmade = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->whereNull('plans.time_checkin')
            ->where('plans.date_end', '>=', date('Y-m-d'))
            ->where('plans.status','=',0)
            ->where('reason_deleted','=',0)
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            $total_plan_made = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->whereNotNull('plans.time_checkin')
            ->where('plans.date_end', '>=', date('Y-m-d'))
            ->whereIn('plans.status',[1,2])
            ->where('plans.reason_deleted','=',0)
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            if($total_plan > 0){
                $plans = DB::table('plans')
                ->leftJoin('users','plans.user_id','=','users.id')
                ->leftJoin('stores','plans.store_id','=','stores.id')
                ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
                ->leftJoin('survey_groups','survey_groups.group_id','=','survey_history.group_id')
                ->where('plans.user_id','=',$user_id)
                ->where('plans.reason_deleted','=',0)
                ->where('plans.date_end', '>=', date('Y-m-d'))
                ->where('users.type_account', '=', 'nhanvien')
                ->select(
                    'plans.id as plan_id',
                    'store_id',
                    'user_id',
                    'plans.route_plan',
                    'date_start',
                    'date_end',
                    'stores.lat',
                    'stores.long',
                    'ip_imei',
                    'time_checkin',
                    'note_admin',
                    'note_employee',
                    'store_code',
                    'store_code_new',
                    'store_name',
                    'store_phone',
                    'stores.address',
                    'asm_name',
                    'asm_phone',
                    'survey_group_ids',
                    'survey_groups.group_name',
                    'questions',
                    'plans.status as plan_status'
                )
                ->orderBy('time_checkin','ASC')
                ->orderBy('date_start','ASC')
                ->orderBy('plan_id','ASC')
                ->get();
            }else{
                $plans = array();
            }
            return response()->json([
                'api_name' => 'Plan List API',
                'data' => $plans,
                'total_plan' =>$total_plan,
                'total_plan_making' => $total_plan_making,
                'total_plan_unmade' => $total_plan_unmade,
                'total_plan_made' => $total_plan_made,
                'status' => 1
            ],200);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(
                [
                    'message' => Messages::MSG_0018,
                    'log' => ''.$e
            ], 500);
        }
    }

    public function get_plan_by_id(Request $request){ 
        try{
            $query_data = $request;
            DB::enableQueryLog();
            $user_id = $query_data['user_id'];
            $plan_id = $query_data['plan_id'];
            if(empty($plan_id)){
                return response()->json(
                    [
                        'message' => 'Không tồn tại plan_id',
                        'status' => 0
                ], 500);
            }
            $total_plan = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->where('plans.reason_deleted','=',0)
            ->where('plans.id','=',$request['plan_id'])
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            if($total_plan > 0){
                $plans = DB::table('plans')
                ->leftJoin('users','plans.user_id','=','users.id')
                ->leftJoin('stores','plans.store_id','=','stores.id')
                ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
                ->leftJoin('survey_groups','survey_groups.group_id','=','survey_history.group_id')
                ->where('plans.user_id','=',$user_id)
                ->where('plans.reason_deleted','=',0)
                ->where('plans.id','=',$request['plan_id'])
                ->where('users.type_account', '=', 'nhanvien')
                ->select(
                    'plans.id as plan_id',
                    'store_id',
                    'user_id',
                    'plans.route_plan',
                    'date_start',
                    'date_end',
                    'stores.lat',
                    'stores.long',
                    'ip_imei',
                    'time_checkin',
                    'note_admin',
                    'note_employee',
                    'store_code',
                    'store_code_new',
                    'store_name',
                    'store_phone',
                    'stores.address',
                    'asm_name',
                    'asm_phone',
                    'survey_group_ids',
                    'survey_groups.group_name',
                    'questions'
                )
                ->orderBy('time_checkin','ASC')
                ->orderBy('date_start','ASC')
                ->orderBy('plan_id','ASC')
                ->get();
            }else{
                $plans = array();
            }
            return response()->json([
                'api_name' => 'Plan By ID API',
                'data' => $plans,
                'status' => 1
            ],200);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(
                [
                    'message' => Messages::MSG_0018,
                    'log' => ''.$e
            ], 500);
        }
    }

    public function checkin(Request $request){
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
            if(empty($data['plan_id'])){
                return response()->json(
                    [
                        'message' => Messages::MSG_0022,
                        'status' => 0
                ], 500);
            }

            $check_checkin = Plan::where('id', $data['plan_id'])
            ->where('user_id', $data['user_id'])->select('time_checkin','lat','long')->first();
            if(!empty($check_checkin->time_checkin) && !empty($check_checkin->lat)){
                return response()->json([
                    'message' => 'Buổi tiệc đã check in vào lúc '.$check_checkin->time_checkin,
                    'lat' => $check_checkin->lat,
                    'long' => $check_checkin->long,
                    'status' => 1
                ],200);
            }
            $check_update = Plan::where('id', $data['plan_id'])
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

    public function get_dashboard(Request $request){
        $query_data = $request;
        DB::enableQueryLog();
        $user_id = $query_data['user_id'];
        $total_plan = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
        $total_make_done = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.status','>','0')
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $total_make_not_done = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.status','=','0')
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $total_make_today = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.status','>','0')
        ->where('plans.time_checkin','LIKE',date('Y-m-d').'%')
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        return response()->json([
            'api_name' => 'Dashboard API',
            'total_plan' => $total_plan,
            'total_make_done' =>$total_make_done,
            'total_make_not_done' =>$total_make_not_done,
            'total_make_today' => $total_make_today,
            'status' => 1
        ],200);
    }

    public function get_search_plan(Request $request){
        try{
            $query_data = $request;
            DB::enableQueryLog();
            $user_id = $query_data['user_id'];
            if(empty($query_data['txt_search'])){
                return response()->json([
                    'message' => 'Vui lòng nhập từ khoá cần tìm kiếm',
                    'status' => '0'
                ],500);
            }
            $total_plan = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->where('users.type_account', '=', 'nhanvien')
            ->where(function ($query) use ($query_data) {
                $query->orWhere('store_name', 'LIKE','%'.$query_data['txt_search'].'%')
                ->orWhere('store_code_new', 'LIKE','%'.$query_data['txt_search'].'%')
                ->orWhere('store_phone', 'LIKE','%'.$query_data['txt_search'].'%')
                ->orWhere('stores.address', 'LIKE','%'.$query_data['txt_search'].'%');
            })
            ->count();
            if($total_plan > 0){
                $plans = DB::table('plans')
                    ->leftJoin('users','plans.user_id','=','users.id')
                    ->leftJoin('stores','plans.store_id','=','stores.id')
                    ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
                    ->where('plans.user_id','=',$user_id)
                    ->where('users.type_account', '=', 'nhanvien')
                    ->where(function ($query) use ($query_data) {
                        $query->orWhere('store_name', 'LIKE','%'.$query_data['txt_search'].'%')
                        ->orWhere('store_code_new', 'LIKE','%'.$query_data['txt_search'].'%')
                        ->orWhere('store_phone', 'LIKE','%'.$query_data['txt_search'].'%')
                        ->orWhere('stores.address', 'LIKE','%'.$query_data['txt_search'].'%');
                    })
                    ->select(
                        'plans.id as plan_id',
                        'store_id',
                        'user_id',
                        'plans.route_plan',
                        'date_start',
                        'date_end',
                        'stores.lat',
                        'stores.long',
                        'ip_imei',
                        'time_checkin',
                        'note_admin',
                        'note_employee',
                        'store_code',
                        'store_code_new',
                        'store_name',
                        'store_phone',
                        'asm_name',
                        'asm_phone',
                        'survey_group_ids',
                        'questions'
                    )
                    ->orderBy('time_checkin','ASC')
                    ->orderBy('date_start','ASC')
                    ->orderBy('plan_id','ASC')
                    ->get();
            }else{
                $plans = array();
            }
            return response()->json([
                'api_name' => 'Looking Plan API',
                'data' => $plans,
                'total_plan' =>$total_plan,
                'status' => 1
            ],200);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(
                [
                    'message' => Messages::MSG_0018,
                    'log' => ''.$e
            ], 500);
        }
    }

    public function get_detail_plan(Request $request){
        try{
            $query_data = $request;
            DB::enableQueryLog();
            $user_id = $query_data['user_id'];
            if(empty($query_data['plan_id'])){
                return response()->json([
                    'message' => 'Không có param id plan',
                    'status' => '0'
                ],500);
            }
            $total_plan = DB::table('plans')
            ->leftJoin('users','plans.user_id','=','users.id')
            ->leftJoin('stores','plans.store_id','=','stores.id')
            ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->where('plans.id','=',$query_data['plan_id'])
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            if($total_plan > 0){
                $plans = DB::table('plans')
                ->leftJoin('users','plans.user_id','=','users.id')
                ->leftJoin('stores','plans.store_id','=','stores.id')
                ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
                ->where('plans.user_id','=',$user_id)
                ->where('plans.id','=',$query_data['plan_id'])
                ->where('users.type_account', '=', 'nhanvien')
                ->select(
                    'plans.id as plan_id',
                    'store_id',
                    'user_id',
                    'plans.route_plan',
                    'date_start',
                    'date_end',
                    'stores.lat',
                    'stores.long',
                    'ip_imei',
                    'time_checkin',
                    'note_admin',
                    'note_employee',
                    'store_code',
                    'store_code_new',
                    'store_name',
                    'store_phone',
                    'asm_name',
                    'asm_phone',
                    'survey_group_ids',
                    'questions'
                )
                ->orderBy('time_checkin','ASC')
                ->orderBy('date_start','ASC')
                ->orderBy('plan_id','ASC')
                ->get();
            }else{
                return response()->json([
                    'api_name' => 'Plan Detail API',
                    'status' => 0,
                    'message' => 'Không tồn tại plan_id ' .$query_data['plan_id']
                ],200);
            }
            return response()->json([
                'api_name' => 'Plan Detail API',
                'data' => $plans,
                'total_plan' =>$total_plan
            ],200);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(
                [
                    'message' => Messages::MSG_0018,
                    'log' => ''.$e
            ], 500);
        }
    }
    public function upload_plan_images(Request $request){
        // try{
            if(empty($request['photos'])){
                return response()->json(
                    [
                        'message' => 'Không nhận được dữ liệu',
                        'status' => 0
                ], 500);
            }else{
                $list_photos = isset($request['photos']) ? $request['photos'] : array();
                $check_status = [];
                foreach($list_photos as $photo_data){
                    $arr_photo = explode(';base64,', $photo_data['photo']);
                    list($extension, $content) = $arr_photo;
                    $tmpExtension = explode('/', $extension);
                    preg_match('/.([0-9]+) /', microtime(), $m);
                    $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
                    
                    $storage = Storage::disk('local');
                    
                    $folder = 'photos/'.date('Y-m-d').'/'.$request['plan_id'].'/'.$photo_data['type'];
                    $checkDirectory = $storage->exists($folder);
                    if (!$checkDirectory) {
                        $storage->makeDirectory($folder);
                    }
                    $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
                    $check_status[] = PlanImage::insert([
                        'plan_id' => $request['plan_id'],
                        'user_id' => $request['user_id'],
                        'link_image' => $folder . '/' . $fileName,
                        'type_image' => $photo_data['type'],
                        'created_at' => date('Y-m-d H:i:s') 
                    ]);
                }
                if(!in_array(0,$check_status)){
                    return response()->json(
                        [
                            'api_name'=> 'Upload Plan Images API',
                            'message' => 'Upload dữ liệu thành công',
                            'status' => 1,
                    ], 200);
                }else{
                    return response()->json(
                        [
                            'api_name'=> 'Upload Plan Images API',
                            'message' => 'Upload dữ liệu không thành công',
                            'status' => 0,
                    ], 500);
                }
            }
        // }catch(Exception $e){
        //     return response()->json(
        //         [
        //             'api_name'=> 'Upload Plan Images API',
        //             'message' => 'Upload dữ liệu không thành công',
        //             'status' => 0,
        //             'log' => ''.$e
        //     ], 500);
        // }
    }
    public function upload_plan_surveys(Request $request){
        if(empty($request['data_json'])){
            return response()->json(
                [
                    'api_name'=> 'Update Plan Survey',
                    'message' => 'Không nhận được dữ liệu!',
                    'status' => 0
            ], 500);
        }else{
            $check = PlanSurvey::updateOrCreate([
                'plan_id'   => $request['plan_id'],
                'user_id'   => $request['user_id']
            ],[
                'data_json'     => $request['data_json'],
                'result' => $request['result'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            if($check){
                return response()->json(
                    [
                        'api_name'=> 'Update Plan Survey',
                        'message' => 'Cập nhật dữ liệu thành công!',
                        'status' => 1,
                        'check' => $check
                ], 500);
            }else{
                return response()->json(
                    [
                        'api_name'=> 'Update Plan Survey',
                        'message' => 'Cập nhật dữ liệu không thành công!',
                        'status' => 0
                ], 500);
            }
        }

    }

    public function add_plan(Request $request){
        if(empty($request['store_id'])){
            $last_store_id = Store::orderBy('id','desc')->first('id')->id;
            $store_id = Store::insertGetId([
                'store_code' => 'E-STORE000'.($last_store_id + 1),
                'store_name' => $request['store_name'],
                'store_phone' => $request['store_phone'],
                'address' => $request['address'],
                'province_id' => $request['province_id'],
                'store_note' => $request['store_note'],
                'survey_group_ids' => $request['survey_id'],
                'asm_name' => '',
                'asm_phone' => '',
                'level' => '',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            if($store_id){
                $check_plan_create = Plan::insert([
                    'store_id' => $store_id,
                    'user_id' => $request['user_id'],
                    'route_plan'=> date('Y-m',strtotime($request['date_start'])),
                    'date_start' => $request['date_start'],
                    'date_end' => $request['date_end'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                if($check_plan_create){
                    return response()->json(
                        [
                            'api_name'=> 'API Add Plan',
                            'message' => 'Tạo plan thành công!',
                            'status' => 1
                    ], 200);
                }else{
                    return response()->json(
                        [
                            'api_name'=> 'API Add Plan',
                            'message' => 'Tạo plan cho buổi tiệc không thành công!',
                            'status' => 0
                    ], 500);
                }
            }else{
                return response()->json(
                    [
                        'api_name'=> 'API Add Plan',
                        'message' => 'Tạo buổi tiệc không thành công!',
                        'status' => 0
                ], 500);
            }
        }else{
            $check_plan_create = Plan::insert([
                'store_id' => $request['store_id'],
                'user_id' => $request['user_id'],
                'route_plan'=> date('Y-m',strtotime($request['date_start'])),
                'date_start' => $request['date_start'],
                'date_end' => $request['date_end'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
            if($check_plan_create){
                return response()->json(
                    [
                        'api_name'=> 'API Add Plan',
                        'message' => 'Tạo plan thành công!',
                        'status' => 1
                ], 200);
            }else{
                return response()->json(
                    [
                        'api_name'=> 'API Add Plan',
                        'message' => 'Tạo plan cho buổi tiệc không thành công!',
                        'status' => 0
                ], 500);
            }
        }
    }
    
    public function add_note(Request $request){ 
        try{
            if(empty($request['content_note'])){
                return response()->json(
                    [
                        'api_name'=> 'API Add Plan Note',
                        'message' => 'Không có nội dung nào được gửi đi!',
                        'status' => 0
                ], 500);
            }
            if(empty($request['plan_id'])){
                return response()->json(
                    [
                        'api_name'=> 'API Add Plan Note',
                        'message' => 'Không nhận được plan_id!',
                        'status' => 0
                ], 500);
            }
            $plan = Plan::find($request['plan_id']);
            $plan->note_employee = $request['content_note'];
            $plan->save();
            return response()->json(
                [
                    'api_name'=> 'API Add Plan Note',
                    'message' => 'Nội dung ghi chú đã được cập nhật!',
                    'status' => 1
            ], 200);
        }catch(Exception $e){
            return response()->json(
                [
                    'api_name'=> 'API Add Plan Note',
                    'message' => 'Không cập nhật được nội dung note!',
                    'status' => 0
            ], 500);
        }
    }
    public function update_reason(Request $request){ 
        try{
            if(empty($request['reason_id'])){
                return response()->json(
                    [
                        'api_name'=> 'API Plan Reasons',
                        'message' => 'Vui lòng chọn lý do không thành công!',
                        'status' => 0
                ], 500);
            }
            if(empty($request['plan_id'])){
                return response()->json(
                    [
                        'api_name'=> 'API Add Plan Reasons',
                        'message' => 'Không nhận được plan_id!',
                        'status' => 0
                ], 500);
            }
            $plan = Plan::find($request['plan_id']);
            $plan->reason_id = $request['reason_id'];
            $plan->note_employee = $request['notes'];
            $plan->save();
            return response()->json(
                [
                    'api_name'=> 'API Add Plan Reasons',
                    'message' => 'Bạn đã lưu thành công lý do!',
                    'status' => 1
            ], 200);
        }catch(Exception $e){
            return response()->json(
                [
                    'api_name'=> 'API Add Plan Reasons',
                    'message' => 'Không cập nhật được lý do!',
                    'status' => 0
            ], 500);
        }
    }
    public function update_status_plan(Request $request){ 
        try{
            if(empty($request['status'])){ // 1: thành công , 2: không thành công
                return response()->json(
                    [
                        'api_name'=> 'API Update Status',
                        'message' => 'Không nhận được trạng thái!',
                        'status' => 0
                ], 500);
            }
            if(empty($request['plan_id'])){
                return response()->json(
                    [
                        'api_name'=> 'API Update Status',
                        'message' => 'Không nhận được plan_id!',
                        'status' => 0
                ], 500);
            }
            $check_plan = Plan::where('id',$request['plan_id'])
            ->where('user_id',$request['user_id'])
            ->first();
            if(!empty($check_plan)){
                $check_update = DB::table('plans')->where('id',$request['plan_id'])->update([
                    'status' => $request['status'],
                    'date_upload' => date('Y-m-d H:i:s')
                ]);
                if($check_update){
                    return response()->json(
                        [
                            'api_name'=> 'API Update Status',
                            'message' => 'Bạn đã cập nhật buổi tiệc thành công!',
                            'status' => 1
                    ], 200);
                }else{
                    return response()->json(
                        [
                            'api_name'=> 'API Update Status',
                            'message' => 'Không cập nhật được dữ liệu!',
                            'status' => 0
                    ], 500);
                }
            }else{
                return response()->json(
                    [
                        'api_name'=> 'API Update Status',
                        'message' => 'Không tìm thấy plan!',
                        'status' => 0
                ], 500);
            }
        }catch(Exception $e){
            return response()->json(
                [
                    'api_name'=> 'API Update Status',
                    'message' => 'Không cập nhật được dữ liệu!',
                    'status' => 0
            ], 500);
        }
    }

    public function getListPlans(){
        $users = DB::table('users')
            ->where('users.type_account', '=', 'nhanvien')
            ->select('users.id as user_id', 'username')->get();
        $list_plans = DB::table('stores')
                    ->join('plans', 'stores.id', '=', 'plans.store_id')
                    ->join('users', 'users.id', '=', 'plans.user_id')
                    ->where('users.type_account', '=', 'nhanvien')
                    ->select(
                        'plans.id as plan_id',
                        'plans.store_id',
                        'route_plan',
                        'date_start',
                        'date_end',
                        'username',
                        'telephone',
                        'store_code',
                        'store_name',
                        'stores.address',
                        'asm_name',
                        'asm_phone',
                        'store_note',
                        'plans.status as plan_status'
                    )
                    ->orderByDesc('plans.status')
                    ->paginate(50);
	    return view('list-plans',[
            'list_plans'=>$list_plans,
            'users' => $users
        ]);
    }

    public function getListPlanStatus($plan_status,$user_id){
        $users = DB::table('users')
            ->where('users.type_account', '=', 'nhanvien')
            ->select('users.id as user_id', 'username')->get();

        $plan_status = !empty($plan_status)?$plan_status:'';
        $user_id = !empty($user_id)?$user_id:'';
        $query = DB::table('stores')
                    ->join('plans', 'stores.id', '=', 'plans.store_id')
                    ->join('users', 'users.id', '=', 'plans.user_id')
                    ->where('users.type_account', '=', 'nhanvien');
        if($user_id !== '*'){
            $query->where('plans.user_id', '=', $user_id);
        }
        if($plan_status !== '*'){
            $query->where('plans.status', '=', $plan_status);
        }
        $query->select(
                        'plans.id as plan_id',
                        'plans.store_id',
                        'route_plan',
                        'date_start',
                        'date_end',
                        'username',
                        'telephone',
                        'store_code',
                        'store_name',
                        'stores.address',
                        'asm_name',
                        'asm_phone',
                        'store_note',
                        'plans.user_id as user_id',
                        'plans.status as plan_status'
                    )
                    ->orderByDesc('plans.status');
        $list_plans = $query->paginate(50);
	    return view('list-plans',[
            'list_plans'=>$list_plans,
            'params_search' => [
                'plan_status'=>$plan_status,
                'user_id' => $user_id
            ], 
            'users' => $users
        ]);
    }
    
    // public function getListPlansStatus($plan_status){
    //     $users = DB::table('users')
    //         ->where('users.type_account', '=', 'nhanvien')
    //         ->select('users.id as user_id', 'username')->get();
    //         $list_plans = DB::table('stores')
    //                 ->join('plans', 'stores.id', '=', 'plans.store_id')
    //                 ->join('users', 'users.id', '=', 'plans.user_id')
    //                 ->join('plan_surveys', 'plans.id', '=', 'plan_surveys.plan_id')
    //                 ->where('plans.status', '=', $plan_status)
    //                 ->where('users.type_account', '=', 'nhanvien')
    //                 ->select(
    //                     'plans.id as plan_id',
    //                     'plans.store_id',
    //                     'route_plan',
    //                     'date_start',
    //                     'date_end',
    //                     'username',
    //                     'telephone',
    //                     'store_code',
    //                     'store_name',
    //                     'stores.address',
    //                     'asm_name',
    //                     'asm_phone',
    //                     'store_note',
    //                     'plans.status as plan_status',
    //                     'plan_surveys.data_json',
    //                     'plan_surveys.result as plan_result'
    //                 )
    //                 ->orderByDesc('plans.status')
    //                 ->paginate(50);
	//     return view('list-plans',['list_plans'=>$list_plans,'plan_status_search' => $plan_status, 'users' => $users]);
    // }

    public function getDetailPlan($id){
        $data = array();
        $plan_images = DB::table('plan_images')
                    ->leftjoin('camera_types', 'camera_types.id', '=' ,'plan_images.type_image')    
                    ->where('plan_id',$id)->get();
        $plan_info = DB::table('stores')
                    ->leftjoin('plans', 'stores.id', '=', 'plans.store_id')
                    ->leftjoin('users', 'users.id', '=', 'plans.user_id')
                    ->leftjoin('plan_surveys', 'plans.id', '=', 'plan_surveys.plan_id')
                    ->leftjoin('reasons', 'reasons.reason_id','=', 'plans.reason_id')
                    ->where('plans.id',$id)
                    ->where('users.type_account', '=', 'nhanvien')
                    ->select(
                        'plans.id as plan_id',
                        'plan_name',
                        'plans.store_id',
                        'route_plan',
                        'date_start',
                        'date_end',
                        'plans.user_id',
                        'username',
                        'telephone',
                        'store_code',
                        'store_name',
                        'stores.address',
                        'asm_name',
                        'asm_phone',
                        'time_checkin',
                        'store_note',
                        'plans.status as plan_status',
                        'plans.lat',
                        'plans.long',
                        'plans.reason_id',
                        'reason_name',
                        'plans.date_upload',
                        'plan_surveys.data_json',
                        'result',
                        'note_employee',
                        'note_admin'
                    )
                    ->first();
        $survey_questions = SurveyQuestion::all();
        $question_data = array();
        foreach($survey_questions as $question) {
            $question_data[$question['survey_id']] = array(
                'survey_name' => $question->survey_name,
                'target' => $question->target,
                'survey_id' => $question->survey_id
            );
        }
        $plan_dt_arr = array();
        if(!empty($plan_info->data_json)){
            $plan_datas = json_decode($plan_info->data_json,true);
            foreach($plan_datas as $pl_dt){
                $plan_dt_arr[$question_data[$pl_dt['survey_id']]['survey_id']] = array(
                    'survey_id' => $question_data[$pl_dt['survey_id']]['survey_id'],
                    'survey_name' => $question_data[$pl_dt['survey_id']]['survey_name'],
                    'target' => $question_data[$pl_dt['survey_id']]['target'],
                    'value' => $pl_dt['value'],
                );
            }
        }
        $question_surveys = SurveyHistory::where('route_plan','=',$plan_info->route_plan)->select('questions')->first();
        $group_users = UserGroup::all();
        $plan_checks = array();
        $list_question_dt = !empty($question_surveys->questions)?json_decode($question_surveys->questions,true):array();
        $list_question = array();
        foreach($list_question_dt as $question){
            if($question['survey_deleted'] == 0){
                $list_question[$question['survey_id']] = array(
                    'survey_id' => $question['survey_id'],
                    'survey_name' => $question['survey_name'],
                    'target' => $question['target'],
                );
            }
        }

        $reasons = Reasons::all();
        $data = array(
            'plan_images' => $plan_images,
            'plan_info' => $plan_info,
            'plan_dt_arr' => $plan_dt_arr,
            'list_questions' => $list_question,
            'reasons' => $reasons
        );
	    return view('detail-plan',['data'=>$data]);
    }

    public function updatePlanData(Request $request){
        $data = array();
        if(isset($request->type_data)){
            $check_update_plan = Plan::where('id','=',$request->plan_id)->update(['status'=> $request->type_data]);
            if(!$check_update_plan){
                return response()->json([
                    'status'          => 0,
                    'message' => 'Cập nhật trạng thái không thành công!',
                ]);
            }
        }
        if(!empty($request->type_data) && $request->type_data == 1){
            $data_update = array();
            $check_result = array();
            $data_update = array(
                array(
                    'survey_id' => 1,
                    'value' => $request->data_send['data1']
                ),
                array(
                    'survey_id' => 2,
                    'value' => $request->data_send['data2']
                ),
                array(
                    'survey_id' => 3,
                    'value' => $request->data_send['data3']
                ),
                array(
                    'survey_id' => 4,
                    'value' => $request->data_send['data4']
                    )
            );
            $data_json = json_encode($data_update);
            $result = in_array(0,$check_result)?'Rớt':'Đạt';
            if(!$check_update_plan){
                return response()->json([
                    'status'          => 0,
                    'message' => 'Cập nhật trạng thái không thành công!',
                ]);
            }
            $check_update = PlanSurvey::where('plan_id',$request->plan_id)->updateOrCreate(
                ['plan_id'=>$request->plan_id],
                [
                'data_json' => $data_json,
                'result' => $result,
                'user_id' => $request->user_id,
                'reason_id' => 0,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            if($check_update){
                return response()->json([
                    'status'          => 1,
                    'message' => 'Cập nhật thành công!',
                ]);
            }else{
                return response()->json([
                    'status'          => 0,
                    'message' => 'Cập nhật không thành công!',
                ]);
            }
        }else if(!empty($request->type_data) && $request->type_data == 2){
            if(!empty($request->data_send['id_reason'])  && $request->data_send['id_reason'] !== '*'){
                $reason_id = $request->data_send['id_reason'];
                $reason_data = Reasons::where('reason_id', $reason_id)->first();
                if(!$reason_data){
                    return response()->json([
                        'status'          => 1,
                        'message' => 'Không tim thấy lý do KTC!',
                    ]);
                }else{
                    $check_plan = Plan::where('id',$request->plan_id)->update([
                        'reason_id' => $reason_id
                    ]);  
                    if($check_plan){
                        $plan_info = PlanSurvey::where('plan_id',$request->plan_id)->first();
                        if(!empty($plan_info)){
                            $check_delete = PlanSurvey::where('plan_id',$request->plan_id)->delete();
                        }
                        return response()->json([
                            'status'          => 1,
                            'message' => 'Cập nhật thành công!',
                        ]);
                    }else{
                        return response()->json([
                            'status'          => 0,
                            'message' => 'Dữ liệu không thay đổi!',
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'          => 0,
                    'message' => 'Vui lòng chọn lý do ktc!',
                ]);
            }
        }
    }

    public function uploadImagePlanWeb(Request $request){
        $plan_id = isset($request->plan_id)?$request->plan_id:'';
        $plan_info = DB::table('plans')->leftJoin('stores','plans.store_id', '=', 'stores.id')->where('plan_id','=','plans.id');
        $url_upload = 'photos/test/'.$request->plan_id;
        $path = storage_path($url_upload);

        return $path;
    
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        $file = $request->file('file');
    
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
    
        $file->move($path, $name);
        
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    function fetchImage(Request $request)
    {
        $photo_data = array();
        $images = array();
        $output = '<div class="row">';
        foreach($images as $image)
        {
        $output .= '
        <div class="col-md-2" style="margin-bottom:16px;" align="center">
                    <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                    <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
                </div>
        ';
        }
        $output .= '</div>';
        echo $output;
    }


    function delete(Request $request)
    {
     if($request->get('name'))
     {
        $file = $request->get('name');
        $file->move(base_path('photos/deleted'), $file->getClientOriginalName());
     }
    }

    public function updateDetailPlanWeb(Request $request){
        try{
            $plan_info = Plan::where('id','=',$request->plan_id)->where('user_id','=',$request->user_id)->first();
            if(!empty($plan_info)){
                $check_plan = Plan::where('id','=',$request->plan_id)
                            ->where('user_id','=',$request->user_id)
                            ->update([
                                'time_checkin' => $request->time_checkin,
                                'date_upload' => $request->date_upload,
                                'lat' => $request->latitude,
                                'long' => $request->longitude,
                                'note_admin' => $request->note_admin,
                            ]);
                if($check_plan){
                    return response()->json([
                        'message'          => 'Update thành công!',
                        'status' => 1,
                    ]);
                }else{
                    return response()->json([
                        'message'          => 'Update không thành công!',
                        'status' => 0,
                    ]);
                }
            }else{
                return back()->with('message_alert', 'Không thể update plan');
            }
        }catch(Exception $e){
            return response()->json([
                'message'          => 'Lỗi dữ liệu vui lòng kiểm tra lại!',
                'status' => 0,
            ]);
        }
    }

}
