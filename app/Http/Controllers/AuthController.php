<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helper\TokenGenarate;

class AuthController extends Controller
{
    use TokenGenarate;
    public function login(){
        if(!empty(Session::get('user.info'))){
            return redirect()->route('dashboard');
        }
        return view('login');
    }
    public function checkLogin(Request $request){
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validated){
            $member = User::with('userGroup')
            ->where('users.status',1)
            ->where(function($q) use ($validated) {
                $q->where('telephone', $validated['username']);
            })
            ->orWhere(function($q) use ($validated) {
                $q->where('usercode', $validated['username']);
            })
            ->first();

            if (empty($member)) {
                return back()->with('error', 'Tài khoản chưa được đăng ký');
            }

            $token = "";
            if (Hash::check($validated['password'], $member->password)) {
                $token = $this->generateToken();
                $member->remember_token = $token;
            } else if (!Hash::check($validated['password'], $member->password)) {
                return back()->with('error', 'Tài khoản/mật khẩu không đúng');
            }
            $member->save();
            if(!empty($member)){
                $member_info = array(
                    'usercode' => $member->usercode,
                    'username' => $member->username,
                    'user_id' => $member->id,
                    'group_id' => $member->group_id,
                    'address' => $member->address,
                    'email' => $member->email,
                    'telephone' => $member->telephone,
                    'group_parent_id' => $member->userGroup->parent_id,
                    'group_name' => $member->userGroup->group_name,
                    'group_code' => $member->userGroup->group_code,
                );
                Session::put("user.info", $member_info);
                return redirect()->route('dashboard');
            }
            return redirect()->route('login.page');
        }
    }

    public function profile(){
        $user_info = session()->get('user.info');
        if(empty($user_info)){
            return redirect()->route('login.page');
        }
        $user_detail = User::where('id', $user_info['user_id'])->first();
        return view('profile',[
            'user_info' => $user_detail
        ]);
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login.page');
    }
}
