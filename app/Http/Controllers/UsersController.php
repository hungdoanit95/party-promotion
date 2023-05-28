<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthController\InvokeRequest;
use App\Models\User;
use App\Utils\Messages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Helper\TokenGenarate;
use App\Models\Absence;
use App\Models\AbsenceReason;

class UsersController extends Controller
{  
    use TokenGenarate;
    public function __invoke(Request $request)
    { 
        try {
            $input = $request;

            if(empty($input['version']) || $input['version'] != '1.0.1'){
                return response()->json([
                    'message' => 'Vui lòng update phiên bản mới',
                    'status' => 0
                ], 500);
            }
            if(empty($input['username']) || empty($input['password'])){
                return response()->json([
                    'message' => 'Vui lòng nhập tài khoản/mật khẩu',
                    'status' => 0
                ], 500);
            }
            $member = User::with('userGroup')
            ->where('users.status',1)
            ->where(function($q) use ($input) {
                $q->where('telephone', $input['username']);
            })
            ->orWhere(function($q) use ($input) {
                $q->where('usercode', $input['username']);
            })
            ->first();

            if (empty($member)) {
                return response()->json([
                    'message' => Messages::MSG_0008,
                    'status' => 0
                ], 401);
            }

            $token = "";
            if (Hash::check($input['password'], $member->password)) {
                $token = $this->generateToken();
                $member->remember_token = $token;
            } else if (!Hash::check($input['password'], $member->password)) {
                return response()->json([
                    'message' => Messages::MSG_0008,
                    'status' => 0
                ], 401);
            }
            $member->save();
            return response()->json([
                'api_name' => 'API Login',
                'data' => [
                    "user_id" => $member->id,
                    "group_id"=> $member->group_id,
                    "group_name"=> $member->userGroup->group_name,
                    "usercode"=> $member->usercode,
                    "username"=> $member->username,
                    "password"=> $member->password,
                    "telephone"=> $member->telephone,
                    "email"=> $member->email,
                    "address"=> $member->address,
                    "avatar"=> $member->avatar,
                    "remember_token"=> $member->remember_token,
                    "message" => "Đăng nhập thành công",
                    "status"=> 1
                ],
                'status' => 1
            ],200);
        } catch (\Exception $error) {
            Log::error($error);
            return response()->json(['message' => Messages::MSG_0009], 500);
        }
    }
    public function get_absences(){
        $absence_reasons = AbsenceReason::get();
        return response()->json(
            [
                'api_name'=> 'Api Absence Reason',
                'data' => $absence_reasons,
                'status' => 1
        ], 200);
    }
    public function absence_reasons(Request $request){ 
        if(empty($request['reason_off_id'])){
            return response()->json(
                [
                    'message' => 'Vui lòng chọn lý do nghỉ phép',
                    'status' => 0
            ], 500);
        }
        $check_dateoff = Absence::where('user_id', '=', $request['user_id'])
        ->where('date_off',$request['date_off'])
        ->select('created_at')
        ->limit(1)
        ->get();
        if(!empty($check_dateoff) && count($check_dateoff) > 0){
            return response()->json([
                'message' => 'Bạn đã xin nghỉ phép hôm nay vào lúc: ' .$check_dateoff[0]->created_at,
                'status' => 0,
                'check_dateoff' => $check_dateoff
            ]);
        }else{
            $check_insert = Absence::insert([
                'date_off' => isset($request['date_off'])?$request['date_off']:date('Y-m-d'),
                'user_id' => $request['user_id'],
                'reason_off_id' => $request['reason_off_id'],
                'notes' => $request['notes'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
            if($check_insert){
                return response()->json(
                    [
                        'message' => 'Bạn đã xin phép thành công!',
                        'status' => (int)$check_insert
                ], 200);
            }else{
                return response()->json(
                    [
                        'message' => 'Dữ liệu hiện tại không thể cập nhật vui lòng thông báo cho quản lý của bạn!',
                        'status' => (int)$check_insert
                ], 500);
            }
        }
    }

    //For mobile
    public function update_info_user(Request $request){
        $username = isset($request->username)?$request->username:'';
        $telephone = isset($request->telephone)?$request->telephone:'';
        $email = isset($request->email)?$request->email:'';
        $address = isset($request->address)?$request->address:'';
        $bank_number = isset($request->bank_number)?$request->bank_number:'';
        if(empty($telephone)){
            return response()->json(
                [
                    'name' => 'API Update Info User',
                    'message' => 'Không cập nhật được dữ liệu!',
                    'status' => 0
            ], 500);
        }
        $check_update = User::where('telephone',$telephone)->update([
            'username' => $username,
            'email' => $email,
            'address' => $address,
            'bank_number' => $bank_number
        ]);
        if($check_update){
            return response()->json(
                [
                    'name' => 'API Update Info User',
                    'message' => 'Dữ liệu đã được cập nhật!',
                    'status' => 1
            ], 200);
        }else{
            return response()->json(
                [
                    'name' => 'API Update Info User',
                    'message' => 'Không cập nhật được dữ liệu!',
                    'status' => 0
            ], 500);
        }
    }
    
    public function get_info_user(Request $request){
        $user_id = isset($request->user_id)?$request->user_id:'';
        if(empty($user_id)){
            return response()->json(
                [
                    'name' => 'API Get Info User',
                    'message' => 'Không get được dữ liệu!',
                    'status' => 0
            ], 500);
        }else{
            $user_info = User::where('id', $user_id)->select('telephone','email','address','bank_number','username')->first();
            return response()->json(
                [
                    'name' => 'API Get Info User',
                    'message' => 'Load dữ liệu thành công!',
                    'data' => $user_info,
                    'status' => 1
            ], 200);
        }
    }
}
