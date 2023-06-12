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
use App\Models\Absences;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utils\Messages;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;
use Image;

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
            ->where('plans.id_deleted','=',0)
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
            ->where('plans.id_deleted','=',0)
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
            ->where('plans.id_deleted','=',0)
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
            ->where('plans.id_deleted','=',0)
            ->where('users.type_account', '=', 'nhanvien')
            ->count();
            if($total_plan > 0){
                $plans = DB::table('plans')
                ->leftJoin('users','plans.user_id','=','users.id')
                ->leftJoin('stores','plans.store_id','=','stores.id')
                ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
                ->leftJoin('survey_groups','survey_groups.group_id','=','survey_history.group_id')
                ->where('plans.user_id','=',$user_id)
                ->where('plans.id_deleted','=',0)
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
            ->leftJoin('parties','plans.party_id','=','parties.id')
            ->leftJoin('survey_history','survey_history.group_id','=','stores.survey_group_ids')
            ->where('plans.user_id','=',$user_id)
            ->where('plans.id_deleted','=',0)
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
                ->where('plans.id_deleted','=',0)
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
            ->where('plans.route_plan',date('Y-m'))
            ->where('users.type_account', '=', 'nhanvien')
            ->where('plans.id_deleted',0)
            ->count();
        $total_make_done = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.route_plan',date('Y-m'))
        ->where('plans.status','>','0')
        ->where('plans.id_deleted',0)
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $total_make_not_done = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.route_plan',date('Y-m'))
        ->where('plans.status','=','0')
        ->where('plans.id_deleted',0)
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $total_make_today = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.route_plan',date('Y-m'))
        ->where('plans.status','>','0')
        ->where('plans.id_deleted',0)
        ->where('plans.time_checkin','LIKE',date('Y-m-d').'%')
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $total_success = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.route_plan',date('Y-m'))
        ->where('plans.status','=','1')
        ->where('plans.id_deleted',0)
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $total_unsuccess = DB::table('plans')
        ->leftJoin('users','plans.user_id','=','users.id')
        ->leftJoin('stores','plans.store_id','=','stores.id')
        ->leftJoin('survey_history','survey_history.group_id','LIKE','stores.survey_group_ids')
        ->where('plans.user_id','=',$user_id)
        ->where('plans.route_plan',date('Y-m'))
        ->where('plans.status','=','2')
        ->where('plans.id_deleted',0)
        ->where('users.type_account', '=', 'nhanvien')
        ->count();
        $absences = Absences::where('date_off',date('Y-m-d'))->where('user_id',$user_id)->count();
        return response()->json([
            'api_name' => 'Dashboard API',
            'total_plan' => isset($total_plan)?$total_plan:0,
            'total_make_done' => isset($total_make_done)?$total_make_done:0,
            'total_make_not_done' => isset($total_make_not_done)?$total_make_not_done:0,
            'total_make_today' => isset($total_make_today)?$total_make_today:0,
            'total_success' => isset($total_success)?$total_success:0,
            'total_unsuccess' => isset($total_unsuccess)?$total_unsuccess:0,
            'absences' => isset($absences)?$absences:0,
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
            ->where('plans.id_deleted',0)
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
                    ->where('plans.id_deleted',0)
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
        if(empty($request['photos'])){
            return response()->json(
                [
                    'message' => 'Không nhận được dữ liệu',
                    'status' => 0
            ], 500);
        }else{
            $list_photos = isset($request['photos']) ? $request['photos'] : array();
            $check_status = [];
            $plan_info = Plan::leftjoin('stores','stores.id','plans.store_id')->where('plans.id',$request['plan_id'])->select('plans.lat','plans.long','stores.store_name','time_checkin')->get();
            $text_content = array(
                'latitude' => isset($plan_info[0]->lat)?$plan_info[0]->lat:'',
                'longitude' => isset($plan_info[0]->long)?$plan_info[0]->long:'',
                'store_name' => isset($plan_info[0]->store_name)?$plan_info[0]->store_name:'',
                'time_checkin' => isset($plan_info[0]->time_checkin)?$plan_info[0]->time_checkin:''
            );
            $timestamp = date('Y-m-d H:i:s');
            $latitude = isset($plan_info[0]->lat)?$plan_info[0]->lat:'';
            $longitude = isset($plan_info[0]->long)?$plan_info[0]->long:'';
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
                // $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
                $imageData = base64_decode($content);
                $image = imagecreatefromstring($imageData);
                $textColor = imagecolorallocate($image, 255, 255, 255);
                $fontSize = 16;
                $watermarkX = 10;
                $watermarkY = 10;
                $opacity = 50; 
                imagettftext($image, $fontSize, 0, $watermarkX, $watermarkY, $textColor, storage_path('app/fonts/Roboto-Regular.ttf'), "Location: $latitude, $longitude");
                imagettftext($image, $fontSize, 0, $watermarkX, $watermarkY + $fontSize, $textColor, storage_path('app/fonts/Roboto-Regular.ttf'), "Time: $timestamp");
                imagejpeg($image, $folder . '/' . $fileName);
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

    public function getListPlans(Request $request){
        $user_info = session()->get('user.info');
        $users = DB::table('users')
            ->where('users.type_account', '=', 'nhanvien')
            ->where('users.group_id', '=', 10);
        if(!empty($user_info['group_id'])&& $user_info['group_id'] == 10){
            $users->where('id',$user_info['user_id']);
        }
        $users->select('users.id as user_id', 'username');
        $users = $users->get();
        $plan_status = isset($request->plan_status)?$request->plan_status:'';
        $user_id = !empty($request->user_id)?$request->user_id:'';
        $plan_qc = isset($request->plan_qc)?$request->plan_qc:'';
        $start_date = !empty($request->start_date)?$request->start_date:'';
        $end_date = !empty($request->end_date)?$request->end_date:'';
        $plan_name = !empty($request->plan_name)?$request->plan_name:'';
        $route_plan = !empty($request->route_plan)?$request->route_plan:'';
        $key_search = !empty($request->search)?$request->search:(!empty($request->key_search)?$request->key_search:'');
        $query = DB::table('stores')
        ->leftjoin('plans', 'stores.id', '=', 'plans.store_id')
        ->leftjoin('users', 'users.id', '=', 'plans.user_id')
        ->leftjoin('plan_surveys', 'plan_surveys.plan_id', '=', 'plans.id')
        ->where('users.type_account', '=', 'nhanvien');
        
        if(!empty($key_search)){
            $query->where(function ($query) use ($key_search) {
                $query->where('stores.store_code', 'LIKE', '%'. $key_search . '%')
                ->orWhere('stores.store_name', 'LIKE', '%'. $key_search . '%')
                ->orWhere('stores.store_phone', 'LIKE', '%'. $key_search . '%')
                ->orWhere('stores.address', 'LIKE', '%'. $key_search . '%');
            });
        }

        if(!empty($user_info['group_id'])&&$user_info['group_id'] == 10){
            $query->where('plans.user_id',$user_info['user_id']);
        }
                    
        if(!empty($plan_qc)&&$plan_qc !== '*'){
            if($plan_qc == 2){
                $query->whereIn('plans.id', function($q){
                    $q->select('plan_id')
                    ->from(with(new PlanQc())->getTable())
                    ->groupBy('plan_id');
                });
            }else{
                $query->whereNotIn('plans.id', function($q){
                    $q->select('plan_id')
                    ->from(with(new PlanQc())->getTable())
                    ->groupBy('plan_id');
                });
            }
        }
        if(!empty($user_id) && $user_id !== '*'){
            $query->where('plans.user_id', '=', $user_id);
        }
        if(!empty($plan_status) && $plan_status !== '*'){
            if($plan_status == 0){
                $query->where('plans.status', '=', 0);
                // $query->whereNull('plans.time_checkin');
            }else if($plan_status == 3){
                $query->where('plans.status', '=', 0);
                $query->whereNotNull('plans.time_checkin');
            }else if($plan_status == 4){
                $query->whereIn('plans.status', array(1,2));
            }else{
                $query->where('plans.status', '=', $plan_status);
            }
        }
        if(!empty($start_date) && $start_date !== '*'){
            $query->where('plans.date_start', '>=', $start_date);
        }
        if(!empty($end_date) && $end_date !== '*'){
            $query->where('plans.date_end', '<=', $end_date);
        }
        if(!empty($plan_name) && $plan_name !== '*'){
            $query->where('plan_name', $plan_name);
        }
        if(!empty($route_plan) && $route_plan !== '*'){
            $query->where('route_plan', $route_plan);
        }
        $query->where('plans.id_deleted',0);
        $list_plans = $query->select(
            'plans.id as plan_id',
            'plans.store_id',
            'route_plan',
            'date_start',
            'date_end',
            'username',
            'telephone',
            'store_code',
            'store_name',
            'plans.plan_name',
            'stores.address',
            'asm_name',
            'asm_phone',
            'store_note',
            'time_checkin',
            'plan_surveys.result as result_plan',
            'plans.status as plan_status'
        )
        ->orderByDesc('plans.id')
        ->paginate(50)->appends(request()->query());
        $plan_images = PlanImage::where('type_image', 2)->get();
        $plan_image_dt = array();
        foreach($plan_images as $image){
            $plan_image_dt[$image['plan_id']] = $image['link_image'];
        }
        $plan_qcs = PlanQc::all()->groupBy('plan_id');
        $plan_names = Plan::whereNotNull('plan_name')->groupBy('plan_name')->orderBy('plan_name','DESC')->select('plan_name')->limit(5);
        if(!empty($route_plan) && $route_plan !== '*'){
            $plan_names->where('route_plan', $route_plan);
        }
        if(!empty($start_date) && $start_date !== '*'){
            $plan_names->where('plans.date_start', '>=', $start_date);
        }
        if(!empty($end_date) && $end_date !== '*'){
            $plan_names->where('plans.date_end', '<=', $end_date);
        }
        if(!empty($plan_status) && $plan_status !== '*'){
            $plan_names->where('status', $plan_status);
        }
        $plan_names = $plan_names->get();
	   
        $route_plans = Plan::where('id_deleted',0)->groupBy('route_plan')->select('route_plan')->get();
        return view('list-plans',[
            'list_plans'=>$list_plans,
            'users' => $users,
            'plan_image_dt' => $plan_image_dt,
            'plan_qc' => $plan_qcs,
            'params_search' => [
                'plan_status' => isset($plan_status)?$plan_status:'*',
                'user_id' => $user_id,
                'plan_qc' => isset($plan_qc)?$plan_qc:'*',
                'start_date' => $start_date,
                'end_date' => $end_date,
                'route_plan' => $route_plan,
                'plan_name' => $plan_name
            ],
            'user_logged' => $user_info,
            'route_plans' => $route_plans,
            'plan_names' => $plan_names
        ]);
    }

    public function getDetailPlan($id){
        $user_info = session()->get('user.info');
        // if(empty($user_info)){
        //     return redirect()->route('login.page');
        // }
        $data = array();
        $plan_images = DB::table('plan_images')
                    ->leftjoin('camera_types', 'camera_types.id', '=' ,'plan_images.type_image')  
                    ->where('is_deleted',0)  
                    ->where('plan_id',$id)->select([
                        'plan_id',
                        'user_id',
                        'link_image',
                        'type_image',
                        'type_name',
                        'plan_images.id as id'
                    ])->get();
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
                        'store_phone',
                        'stores.region as region_store',
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
                        'note_admin',
                        'plans.confirm_report',
                        'plans.user_confirm_report',
                        'plans.plan_qc_code'
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
        $plan_qc_codes = array();
        if(!empty($plan_info->plan_qc_code)){
            $plan_qc_codes = array_map('intval', explode(',', $plan_info->plan_qc_code));
        }
        $plan_dt_arr = array();
        if(!empty($plan_info->data_json)){
            $plan_datas = json_decode($plan_info->data_json,true);
            if(!empty($plan_datas)){
                foreach($plan_datas as $pl_dt){
                    if(!empty($pl_dt['survey_id']) && !empty($question_data[$pl_dt['survey_id']]['survey_id'])){
                        $plan_dt_arr[$question_data[$pl_dt['survey_id']]['survey_id']] = array(
                            'survey_id' => $question_data[$pl_dt['survey_id']]['survey_id'],
                            'survey_name' => $question_data[$pl_dt['survey_id']]['survey_name'],
                            'target' => $question_data[$pl_dt['survey_id']]['target'],
                            'value' => $pl_dt['value'],
                        );
                    }
                }
            }
        }
        $question_surveys = SurveyHistory::whereNotNull('id')->select('questions')->first();
        $group_users = UserGroup::where('user_groups.group_id','!=', 10)->get();
        $plan_qcs = DB::table('plan_qc')
        ->leftjoin('users', 'users.id','=','plan_qc.user_id')
        ->leftjoin('user_groups', 'user_groups.group_id','=','users.group_id')
        ->where('plan_qc.plan_id','=',$id)->select('users.username','plan_qc.group_id','plan_qc.user_id','plan_qc.created_at')->get();
        $plan_qc_by_groupid = array();
        if(!empty($plan_qcs)){
            foreach($plan_qcs as $qc){
                $qc = (array)$qc;
                if(!empty($qc['group_id'])){
                    $plan_qc_by_groupid[$qc['group_id']][$qc['user_id']] = array(
                        'username' => $qc['username'],
                        'created_at' => $qc['created_at']
                    );
                }
            }
        }
        $group_users_qc = array();
        if(!empty($group_users)){
            foreach($group_users as $group){
                $group_users_qc[] = array(
                    'group_name' => $group['group_name'],
                    'data' => !empty($plan_qc_by_groupid[$group['group_id']])?$plan_qc_by_groupid[$group['group_id']]:array()
                );
            }
        }
        $list_question_dt = !empty($question_surveys->questions)?json_decode($question_surveys->questions,true):array();
        $list_question = array();
        foreach($list_question_dt as $question){
            if($question['survey_deleted'] == 0){
                $list_question[$question['survey_id']] = array(
                    'survey_id' => $question['survey_id'],
                    'survey_name' => $question['survey_name'],
                    'survey_type' => $question['survey_type'],
                    'survey_answers' => isset($question['survey_answers'])?$question['survey_answers']:array(),
                    'target' => $question['target'],
                );
            }
        }
        $reasons = Reasons::all();
        $cameras = CameraType::all();
        if(!empty($plan_info->user_confirm_report)){
            $user_confirm_report = User::where('id', $plan_info->user_confirm_report)->select('username')->first();
        }
        $code_qcs = CodeQcs::leftjoin('group_qc_codes', 'group_qc_codes.id', 'code_qcs.group_id')->select('name_qc','group_name','group_qc_codes.id as group_id','code_qcs.id as code_id')->get();
        $dt_qc_codes = array();
        foreach($code_qcs as $code_qc){
            $dt_qc_codes[$code_qc['group_id']]['group_code'] = array(
                'group_id' => $code_qc['group_id'],
                'group_name' => $code_qc['group_name'],
            );
            $dt_qc_codes[$code_qc['group_id']]['data_code'][] = array(
                'name_qc' => $code_qc['name_qc'],
                'code_id' => $code_qc['code_id'],
                'group_id' => $code_qc['group_id']
            );
        }
        $dt_plan_notes = PlanNote::leftjoin('users', 'users.id', 'plan_note.user_id')->where('plan_note.plan_id', $id)
        ->select('plan_note.id as note_id','users.username','plan_note.note_type','plan_note.is_done','plan_note.time_is_done','plan_note.note_content','plan_note.created_at')
        ->get();
        $plan_notes = array();
        if(!empty($dt_plan_notes)){
            foreach($dt_plan_notes as $plan_note){
                $plan_notes[$plan_note['note_type']][] = $plan_note;
            }
        }
        $all_overview_stores = array();
        $plan_overview_images = Plan::leftjoin('plan_images','plan_images.plan_id','plans.id')->where('plans.store_id','=',$plan_info->store_id)->where('type_image',2)->select('plans.id','plans.store_id','link_image','type_image','plan_name')->orderBy('plans.id')->limit(5)->get();
        if(isset($plan_overview_images)){
            foreach($plan_overview_images as $plan_image){
                $all_overview_stores[$plan_image['id']] = array(
                    'link_image' =>  $plan_image['link_image'],
                    'id' => $plan_image['id'],
                    'plan_name' => $plan_image['plan_name']
                );
            }
        }
        $dt_l_question = array();
        if($list_question){
            foreach($list_question as $quest){
                $quest['survey_answers'] = !empty($quest['survey_answers'])?json_decode($quest['survey_answers'],1):'';
                $dt_l_question[] = $quest;
            }
        }
        $data = array(
            'plan_images' => $plan_images,
            'plan_info' => $plan_info,
            'plan_dt_arr' => $plan_dt_arr,
            'list_questions' => $dt_l_question,
            'plan_qc_codes' => $plan_qc_codes,
            'reasons' => $reasons,
            'cameras' => $cameras,
            'code_qcs' => $dt_qc_codes,
            'plan_notes' => $plan_notes,
            'user_confirm_report' => isset($user_confirm_report->username)?$user_confirm_report->username:'',
            'user_info' => $user_info,
            'group_users_qcs' => $group_users_qc,
            'all_overview_stores' => $all_overview_stores
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
                    'type_data' => 0,
                    'message' => 'Cập nhật trạng thái không thành công!',
                ]);
            }
        }
        if(!empty($request->type_data) && $request->type_data == 1){
            $data_update = array();
            $data_update = [];
            $total_check = 0;
            $value_8 = 0;
            $value_9 = 0;
            for($i = 0; $i < count($request->data_send); $i++){
                $j = $i + 1;
                $value_rq = isset($request->data_send['data'.$j])?$request->data_send['data'.$j]:'';
                $data_update[] = array(
                    'survey_id' => $j,
                    'value' => $value_rq
                );
                if($j == 8){
                    $value_8 = $value_rq;
                }
                if($j == 9){
                    $value_9 = $value_rq;
                }
                $total_check += $value_rq;
            }
            $data_json = json_encode($data_update);
            $result = (($total_check >= 20 && $value_8 >= 2 && $value_9 >= 2) || ($value_8 >= 10 && $value_9 >= 10))?'Đạt':'Rớt';
            if(!$check_update_plan){
                return response()->json([
                    'status'          => 0,
                    'type_data' => 1,
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
                $check_reason = Plan::where('id',$request->plan_id)->update(['reason_id' => null]);
                return response()->json([
                    'status'          => 1,
                    'type_data' => 1,
                    'result' => $result,
                    'message' => 'Cập nhật thành công!',
                ]);
            }else{
                return response()->json([
                    'status'          => 0,
                    'type_data' => 1,
                    'message' => 'Cập nhật không thành công!',
                ]);
            }
        }else if(!empty($request->type_data) && $request->type_data == 2){
            if(!empty($request->data_send['id_reason'])  && $request->data_send['id_reason'] !== '*'){
                $reason_id = $request->data_send['id_reason'];
                $reason_data = Reasons::where('reason_id', $reason_id)->first();
                if(!$reason_data){
                    return response()->json([
                        'status'          => 0,
                        'type_data' => 2,
                        'message' => 'Không tìm thấy lý do KTC!',
                    ]);
                }else{
                    $check_plan = Plan::where('id',$request->plan_id)->update([
                        'reason_id' => $reason_id
                    ]);  
                    $check_updatedSurvey = PlanSurvey::where('plan_id',$request->plan_id)
                    ->where('user_id',$request->user_id)
                    ->delete();
                    if($check_plan){
                        $plan_info = PlanSurvey::where('plan_id',$request->plan_id)->first();
                        if(!empty($plan_info)){
                            $check_delete = PlanSurvey::where('plan_id',$request->plan_id)->delete();
                        }
                        return response()->json([
                            'status'          => 1,
                            'type_data' => 2,
                            'message' => 'Cập nhật thành công!',
                        ]);
                    }else{
                        return response()->json([
                            'status'          => 0,
                            'type_data' => 2,
                            'message' => 'Dữ liệu không thay đổi!',
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'status'          => 0,
                    'type_data' => 2,
                    'message' => 'Vui lòng chọn lý do ktc!',
                ]);
            }
        }
    }

    public function uploadImagePlanWeb(Request $request){

        $url_upload = 'app/photos/upload/';
        $path = storage_path($url_upload);
    
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

    function updateImageData(Request $request){
        $plan_info = Plan::where('id', $request->plan_id)->first();
        if(!empty($plan_info)){
            $folder_date = !empty($plan_info['time_checkin'])? date('Y-m-d', strtotime($plan_info['time_checkin'])) : $plan_info['date_start'];
            $url_old_upload = storage_path('app/photos/upload/');
            foreach ($request->input('document', []) as $file) {
                $new_link_image = 'photos/'.date('Y-m-d').'/'.$request['plan_id'].'/no-type';
                $url_new_upload = storage_path('app/'.$new_link_image);
                if (!file_exists($url_new_upload)) {
                    mkdir($url_new_upload, 0777, true);
                }
                $check_update_folder = rename($url_old_upload.'/'.$file, $url_new_upload.'/'.$file);
                if($check_update_folder){
                    PlanImage::insert([
                        'plan_id' => $request->plan_id,
                        'user_id' => $plan_info->user_id,
                        'image_name' => $file,
                        'link_image' => $new_link_image.'/'.$file,
                        'type_image' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }else{
                    return back()->with('message_upload_alert', 'Có hình ảnh không thể cập nhật vui lòng thử lại!');
                }
            }
            return back()->with('message_upload_alert', 'Upload thành công!');
        }else{
            return back()->with('message_upload_alert', 'Không tồn tài plan!');
        }

        // return redirect()->route('projects.index');
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


    function deleteImage(Request $request)
    {
     if(!empty($request->id)){
        $check_deleted = PlanImage::where('id',$request->id)->update([
            'is_deleted' => 1
        ]);
        if($check_deleted){
            $plan_image = PlanImage::where('id',$request->id)->first();
            if(!empty($plan_image->link_image)){
                $folder_delete = storage_path('app/image-deleted/'.date('Y-m-d').'/'.$plan_image->plan_id.'/'.$plan_image->type_image.'/');
                if (!file_exists($folder_delete)) {
                    mkdir($folder_delete, 0777, true);
                }
                if( chmod($folder_delete, 0777) ) {
                    chmod($folder_delete, 0755);
                }
                $file = storage_path('app/'.$plan_image->link_image);
                $file_copy = storage_path('app/image-deleted/'.date('Y-m-d').'/'.$plan_image->plan_id.'/'.$plan_image->type_image.'/'.date('Y-m-dHis').'.jpeg');
                if (copy($file, $file_copy)) 
                {   
                    PlanImage::where('id',$request->id)->update([
                        'link_image' => 'image-deleted/'.date('Y-m-d').'/'.$plan_image->image_name
                    ]);
                    unlink($file);
                    return response()->json([
                        'message'          => 'Xoá hình thành công!',
                        'status' => 1,
                    ]);
                }else{
                    return response()->json([
                        'message'          => 'Xoá hình không thành công!',
                        'status' => 0,
                    ]);
                }
            }else{
                return response()->json([
                    'message'          => 'Xoá hình không thành công!',
                    'status' => 0,
                ]);
            }
        }
     }else{
        return response()->json([
            'message'          => 'Không nhận được id hình ảnh cần xoá!',
            'status' => 0,
        ]);
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
                                'note_employee' => $request->staff_note,
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

    public function updateTypeImage(Request $request){
        $id_image = !empty($request->id_image)?$request->id_image:'';
        if(empty($id_image)){
            return response()->json([
                'message'          => 'Lỗi nhận params!',
                'status' => 0,
            ]);
        }
        $plan_image = PlanImage::where('id',$request->id_image)->first();
        if(empty($plan_image)){
            return response()->json([
                'message'          => 'Hình ảnh không còn tồn tại!',
                'status' => 0,
            ]);
        }else{
            $check_update = PlanImage::where('id',$request->id_image)->update([
                'type_image' => $request->type_image
            ]);
            if($check_update){
                return response()->json([
                    'message'          => 'Cập nhật thành công!',
                    'status' => 1,
                ]);
            }else{
                return response()->json([
                    'message'          => 'Cập nhật KTC!',
                    'status' => 0,
                ]);
            }
        }
    }

    public function liveSearch(Request $request)
    {   
        $array_filters = array(
            'plans.user_id' => 'user_id',
            'plan_qc' => 'plan_qc',
            'status' => 'plan_status',
            'plan_name' => 'plan_name',
            'date_start' => 'start_date',
            'date_end' => 'end_date'
        );
        $filter_search = !empty($request['search'])?$request['search']:'';
        if ($request) {
            $output = ''; 
            $query = DB::table('plans')
            ->leftJoin('stores', 'stores.id', '=', 'plans.store_id')
            ->leftJoin('users', 'users.id', '=', 'plans.user_id')
            ->where('users.type_account', '=', 'nhanvien')
            ->where('plans.id_deleted',0)
            ->where(function ($query) use ($filter_search) {
                $query->where('stores.store_code', 'LIKE', '%'. $filter_search . '%')
                ->orWhere('plans.route_plan', 'LIKE', '%'. $filter_search . '%')
                ->orWhere('stores.store_name', 'LIKE', '%'. $filter_search . '%')
                ->orWhere('stores.store_phone', 'LIKE', '%'. $filter_search . '%')
                ->orWhere('stores.address', 'LIKE', '%'. $filter_search . '%');
            });
            foreach($array_filters as $key => $filter){
                if(!empty($request[$filter]) && !in_array($key,array('plan_qc','date_start','date_end'))){
                    $query->where($key, '=', $request->$filter);
                }   
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
                'plans.status as plan_status'
            )
            ->orderByDesc('plans.status')
            ->limit(50);
            $list_plans = $query->get();
            if ($list_plans) {
                foreach ($list_plans as $key => $plan) {
                    $output .= '<tr style="font-size: 14px">';
                    $output .= '<th scope="row"><img width="120" src="/assets/img/store.jpg" /></th>';
                    $output .= '<td>';
                    $output .= '<span style="font-size: 13px">Asm: '.$plan->store_code.'</span> <br/>';
                    $output .= $plan->store_name;
                    $output .= '<hr style="margin: 5px 0; ">';
                    $output .= '<span style="font-size: 13px">Asm: '.$plan->asm_name.'</span> <br/>';
                    $output .= '<span style="font-size: 13px">Note: '.$plan->store_note.'</span>';
                    $output .= '</td>';
                    $output .= '<td>';
                    $output .= $plan->route_plan.' <br/>';
                    $output .= 'Trạng thái: '.$plan->plan_status == 0 ? 'Chưa làm' : ($plan->plan_status == 1? 'Thành công' : 'KTC').' <br />';
                    $output .= '</td>';
                    $output .= '<td>';
                    $output .= $plan->username.' <br/>';
                    $output .= $plan->telephone;
                    $output .= '</td>';
                    $output .= '<td>';
                    $output .= 'Start: '.$plan->date_start.' <br/>';
                    $output .= 'End: '.$plan->date_end;
                    $output .= '</td>';
                    $output .= '<td>';
                    $output .= '<a href="/get-info-plan/'.$plan->plan_id.'" target="_blank"><i class="bx bxs-edit"></i> Chi tiết</a>';
                    $output .= '</td>';
                    $output .= '</tr>';
                }
            }
            return $output;
        }
    }

    public function confirmQcPlan(Request $request){
        $check_plan_qc = PlanQc::updateOrCreate([
            'plan_id' => $request->plan_id,
            'user_id' => $request->user_id,
            'group_id' => $request->group_id
        ]);
        return response()->json([
            'message'          => 'Bạn đã xác nhận thành công!',
            'status' => 1,
        ]);
    }

    public function updateReportPlan(Request $request){
        if(isset($request->user_id)&&isset($request->plan_id)){
            Plan::where('user_id',$request->user_id)->where('id',$request->plan_id)->update([
                'confirm_report' => 1,
                'user_confirm_report' => $request->user_id
            ]);
            return response()->json([
                'message'          => 'Bạn đã xác nhận thành công!',
                'status' => 1,
            ]);
        }else{
            return response()->json([
                'message'          => 'Không nhận được plan_id hoặc user_id!',
                'status' => 0,
            ]);
        }
    }

    public function updatePlanNote(Request $request){
        if(isset($request->type_note) && isset($request->user_id)&&isset($request->plan_id)){
            if($request->type_note == 4){
                Plan::where('id',$request->plan_id)->update([
                    'is_overcome' => 1
                ]);
            }
            $check = PlanNote::updateOrCreate([
                'plan_id' => $request->plan_id,
                'note_type' => $request->type_note,
                'is_done' => '0'
            ],[
                'plan_id' => $request->plan_id,
                'user_id' => $request->user_id,
                'note_content' => $request->content_note,
                'note_type' => $request->type_note,
                'is_done' => '0'
            ]);

            return response()->json([
                'message'          => 'Bạn đã xác nhận thành công!',
                'status' => 1,
                'time_update' => isset($check['updated_at'])?date('Y-m-d', strtotime($check['updated_at'])):(isset($check['created_at'])?date('Y-m-d',strtotime(isset($check['created_at']))):'')
            ]);
        }else{
            return response()->json([
                'message'          => 'Thiếu params truyền vào!',
                'status' => 0,
            ]);
        }
    }
    public function updateStatusPlanNote(Request $request){
        if(!empty($request->id_plan_note) && !empty($request->type_update)){
            if($request->type_update == 'done'){
                PlanNote::where('id', $request->id_plan_note)->update([
                    'is_done' => 1,
                    'time_is_done' => date('Y-m-d H:i:s')
                ]);
                return response()->json([
                    'message'          => 'Cập nhật trạng thái đã xong!',
                    'status' => 1,
                ]);
            }else if($request->type_update == 'delete'){
                PlanNote::where('id', $request->id_plan_note)->delete();
                return response()->json([
                    'message'          => 'Xoá thành công!',
                    'status' => 1,
                ]);
            }
        }else{
            return response()->json([
                'message'          => 'Thiếu params truyền vào!',
                'status' => 0,
            ]);
        }
    }
    public function updateQcCode(Request $request){
        if(!empty($request->plan_id)&&!empty($request->user_id)){
            Plan::where('id',$request->plan_id)->update([
                'plan_qc_code' => $request->data_code
            ]);
            PlanQcCode::updateOrCreate([
                'plan_id'=>$request->plan_id
            ],[
                'plan_id'=>$request->plan_id,
                'user_tick_code'=>$request->user_id,
                'qc_code'=>!empty($request->data_code)?$request->data_code:'',
                'created_at'=>date('Y-m-d H:i:s')
            ]);
            return response()->json([
                'message'          => 'Cập nhật thành công!',
                'status' => 1,
            ]);
        }else{
            return response()->json([
                'message'          => 'Thiếu params truyền vào!',
                'status' => 0,
            ]);
        }
    }
    public function deletePlan(Request $request){
        $user_info = session()->get('user.info');
        if(empty($user_info['user_id']) && empty($request->user_id)){
            return response()->json([
                'message'          => 'Vui lòng login để xử dụng chức năng!',
                'status' => 0,
            ]);
        }
        $user_delete_id = !empty($request->user_id)?$request->user_id:$user_info['user_id'];
        if($request->plan_id){
            $check_update = Plan::where('id',$request->plan_id)->update([
                'id_deleted' => $user_delete_id,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            if($check_update){
                return response()->json([
                    'message'          => 'Bạn đã xoá thành công!',
                    'status' => 1,
                ]);
            }else{
                return response()->json([
                    'message'          => 'Bạn đã xoá không thành công!',
                    'status' => 0,
                ]);
            }
        }else{
            return response()->json([
                'message'          => 'Không nhận được ID plan cần xoá!',
                'status' => 0,
            ]);
        }
    }
    public function transferPlan(Request $request){
        $user_info = session()->get('user.info');
        if(empty($user_info)){
            return response()->json([
                'message' => 'Vui lòng đăng nhập để sử dụng chức năng',
                'status' => 0
            ]);
        }
        $all_users = User::select(['id','username'])->get();
        $group_month = Plan::groupBy('route_plan')->select('route_plan')->get();
        if(empty($request->user_old) || empty($request->user_new)){
            return view('transfer-plans',[
                'data'=>[
                    'all_users' => $all_users,
                    'group_month' => $group_month
                ]
            ]);
        }
    }
    public function updateTransferPlan(Request $request){
        $user_info = session()->get('user.info');
        if(empty($user_info)){
            return response()->json([
                'message' => 'Vui lòng đăng nhập để sử dụng chức năng',
                'status' => 0
            ]);
        }
        if( 
            empty($request->user_old_id) && $request->user_old_id !== '*' || 
            empty($request->user_new_id) && $request->user_new_id !== '*' || 
            empty($request->month) && $request->month !== '*'
        ){
            return response()->json([
                'message'          => 'Vui lòng đủ người chuyển, người nhận và tháng của plan!',
                'status' => 0,
            ]);
        }
        $data_update = [
            'user_id' => $request->user_new_id,
            'user_transfer_id'=>$user_info['user_id'],
            'time_transfer' => date('Y-m-d H:i:s'),
            'old_user_id' => $request->user_old_id
        ];
        $check_update = Plan::where('route_plan', $request->month)->where('user_id', $request->user_old_id)->update($data_update);
        if($check_update){
            return response()->json([
                'message'          => 'Bạn đã chuyển plan thành công!',
                'status' => 1,
            ]);
        }else{
            return response()->json([
                'message'          => 'Chuyển plan không thành công!',
                'status' => 1,
            ]);
        }
    }
    public function reCalculateResult(Request $request){
        $plan_surveys = PlanSurvey::all();
        if(!empty($plan_surveys)){
            foreach($plan_surveys as $survey){
                if(!empty($survey->data_json)){
                    $data_recalculate = json_decode($survey->data_json);
                    $total_check = 0;
                    $check_pass = array();
                    $survey_8_value = 0;
                    $survey_9_value = 0;
                    foreach($data_recalculate as $calculate){
                        if(!empty($calculate->survey_id) && !empty($calculate->value)){
                            if($calculate->survey_id == 8 && $calculate->value == 10 || $calculate->survey_id == 9 && $calculate->value == 10){
                                $check_pass[] = 1;
                            }
                            if($calculate->survey_id == 8){
                                $survey_8_value = $calculate->value;
                            }
                            if($calculate->survey_id == 9){
                                $survey_9_value = $calculate->value;
                            }
                            if($calculate->survey_id >= 8){
                                $total_check += (int)$calculate->value;
                            }
                        }
                    }
                    if(count($check_pass) == 2 || $total_check >= 20 && $survey_8_value >= 2 && $survey_9_value >= 2){
                        $result_label = 'Đạt';
                    }else{
                        $result_label = 'Rớt';
                    }
                    PlanSurvey::where('id',$survey->id)->update([
                        'result' => $result_label,
                    ]);
                }
            }
            return response()->json([
                'message'          => 'Đã tính toán lại đạt rớt thành công',
                'status' => 1,
            ]);
        }else{
            return response()->json([
                'message'          => 'Không có kết quả nào được tính toán lại',
                'status' => 0,
            ]);
        }
    }
}
