<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifyApiCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(empty($request['token_key'])){
            return response()->json([
                'message' => 'Thiếu params token key',
                'status' => '0'
            ],500);
        }
        if(empty($request['user_id'])){
            return response()->json([
                'message' => 'Không nhận được param user_id',
                'status' => '0'
            ],500);
        }else{
            $users = DB::table('users')->where('id','=',$request['user_id'])->get()->toArray();
            if(empty($users)){
                return response()->json([
                    'message' => 'User không tồn tại!',
                    'status' => '0'
                ],500);
            }
        }
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );
        
        if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
            if (!$request->secure()) {
                return redirect()->secure($request->path());
            }
        }
        return $next($request);
    }
}
