<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanImage;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    public function getStores(Request $request){
        $key_search = isset($request->key_search) ? rawurldecode($request->key_search) : '';
        if($key_search){
            $store_data = Store::where(function($query) use ($key_search){
                $query->where('store_code','LIKE','%'.$key_search.'%')
                ->orWhere('store_code','LIKE','%'.$key_search.'%')
                ->orWhere('store_code_new','LIKE','%'.$key_search.'%')
                ->orWhere('store_name','LIKE','%'.$key_search.'%')
                ->orWhere('store_name_new','LIKE','%'.$key_search.'%')
                ->orWhere('store_phone','LIKE','%'.$key_search.'%')
                ->orWhere('store_phone_new','LIKE','%'.$key_search.'%')
                ->orWhere('address','LIKE','%'.$key_search.'%')
                ->orWhere('address_new','LIKE','%'.$key_search.'%')   
                ->orWhere('asm_name','LIKE','%'.$key_search.'%')
                ->orWhere('asm_phone','LIKE','%'.$key_search.'%');
            })->where('id_deleted',0);
            $stores = $store_data->orderByDesc('id')->paginate(50);
        }else{
            $stores = Store::where('id_deleted', 0)->orderByDesc('id')->paginate(50);
        }
        return view('stores',[
            'store_lists' => $stores,
            'key_search' => isset($request['key_search']) ? $request['key_search'] : ''
        ]);
    }

    public function update_store_info(Request $request){
        $plan_id = isset($request->plan_id)?$request->plan_id:'';
        if(empty($plan_id)){
            return response()->json(
                [
                    'api_name'=> 'API Add Update Store',
                    'message' => 'Không nhận được plan_id!',
                    'status' => 0
            ], 500);
        }
        $store_id = DB::table('plans')
        ->leftJoin('stores', 'stores.id', 'plans.store_id')
        ->where('plans.id', $plan_id)
        ->select('plans.store_id as store_id')
        ->first()->store_id;
        $name_store = isset($request->name_store)?$request->name_store:'';
        $address_store = isset($request->address_store)?$request->address_store:'';
        $phone_store = isset($request->phone_store)?$request->phone_store:'';
        $long_store = isset($request->long_store)?$request->long_store:'';
        $lat_store = isset($request->lat_store)?$request->lat_store:'';
        $check_update = [];
        if(!empty($name_store) || !empty($address_store) || !empty($phone_store)){
            Store::where('id', $store_id)->update([
                'store_name_new' => $name_store,
                'address_new' => $address_store,
                'store_phone_new' => $phone_store
            ]);
            $check_update[] = 1;
        }
        if(!empty($long_store) || !empty($lat_store)){
            Plan::where('id', $plan_id)->update([
                'lat_new' => $lat_store,
                'long_new' => $long_store
            ]);
            $check_update[] = 1;
        }
        if(!empty($check_update)){
            return response()->json(
                [
                    'api_name'=> 'API Add Update Store',
                    'message' => 'Cập nhật dữ liệu thành công!',
                    'status' => 1
            ], 200);
        }else{
            return response()->json(
                [
                    'api_name'=> 'API Add Update Store',
                    'message' => 'Dữ liệu không thể cập nhật!',
                    'status' => 0
            ], 500);
        }
    }
    function updateOverviewStores(Request $request){
        if($request->update_overview){
            $plan_images = DB::table('stores')->leftJoin('plans','plans.store_id','stores.id')
            ->leftJoin('plan_images','plan_images.plan_id','plans.id')->whereNull('stores.overview_img')->where('plan_images.type_image',2)->select([
                'plans.id as plan_id',
                'stores.id as store_id',
                'plan_images.link_image as link_image'
            ])->get();
            $data_plan_images = array();
            foreach ($plan_images as $plan_image){
                $data_plan_images[$plan_image->store_id] = $plan_image->link_image;
            }
            foreach($data_plan_images as $store_id => $data_update){
                Store::where('id', $store_id)->update([
                    'overview_img' => $data_update
                ]);
            }
            return response()->json(
                [
                    'api_name'=> 'API Update Overview Store',
                    'message' => 'Cập nhật overview thành công',
                    'status' => 0
            ], 200);
        }else{
            return response()->json(
                [
                    'api_name'=> 'API Update Overview Store',
                    'message' => 'Cập nhật overview không thành công',
                    'status' => 0
            ], 500);
        }
    }
    function get_store_info_by_plan_id(Request $request){
        $plan_id = isset($request->plan_id)?$request->plan_id:'';
        if(empty($plan_id)){
            return response()->json(
                [
                    'api_name'=> 'API Add Update Store',
                    'message' => 'Không nhận được plan_id!',
                    'status' => 0
            ], 500);
        }
        $store_info = DB::table('plans')
        ->leftJoin('stores', 'stores.id', 'plans.store_id')
        ->where('plans.id', $plan_id)
        ->select(['plans.store_id as store_id','stores.*'])
        ->first();
        if($store_info){
            return response()->json(
                [
                    'api_name'=> 'API Add Update Store',
                    'message' => 'Tải dữ liệu thành công!',
                    'data' => $store_info,
                    'status' => 1
            ], 200);
        }else{
            return response()->json(
                [
                    'api_name'=> 'API Add Update Store',
                    'message' => 'Tải dữ liệu không thành công!',
                    'status' => 0
            ], 500);
        }
    }
    public function groupStoreCode(Request $request){
        $user_info = session()->get('user.info');
        if(empty($user_info)){
            return response()->json([
                'status' => 0,
                'message' => 'Vui lòng đăng nhập để sử dụng chức năng'
            ]);
        }
        // DB::beginTransaction();
        // try{
            $data_updates = array();
            $data_deletes = DB::select(DB::raw("WITH CTE AS ( SELECT *,ROW_NUMBER() OVER (PARTITION BY store_name ORDER BY store_name) AS RN FROM stores WHERE id_deleted = 0 ) select `id`,`store_name`,`address` FROM CTE WHERE RN<>1"));
            // $data_deletes = Store::all();
            if(!empty($data_deletes)){
                foreach($data_deletes as $data_del){
                    if(!empty($data_del->store_name) && !empty($data_del->address)){
                        $city_update = '';
                        $address_plan = explode(',',$data_del->address);
                        $new_array_address = array_values(array_filter($address_plan, fn($value) => !is_null($value) && $value !== '' && $value !== ' ' && $value !== '.'));
                        $count_address = count($new_array_address);
                        $city_update = trim($new_array_address[$count_address - 1]);
                        $data_updates[$city_update][$data_del->store_name][] = array(
                            'plan_id_update' => $data_del->id,
                            'address' => implode(',', $new_array_address),
                            'city_name' => $city_update
                        );
                    }
                };
            }

            // Update City Name for Store
            
            // foreach($data_updates as $city_data_store){
            //     foreach($city_data_store as $data_store){
            //         foreach($data_store as $store){
            //             Store::where('id', $store['plan_id_update'])->update([
            //                 'city_name' => $store['city_name'],
            //                 'address' => $store['address']
            //             ]);
            //         }
            //     }
            // }
            // return response()->json([
            //     'message' => 'update thành công',
            //     'status' => 1
            // ]);



            $check_update = 0;
            foreach($data_updates as $city_name_key=>$data_update){
                if(!empty($data_update)){
                    foreach($data_update as $id_store_update){
                        return $id_store_update;
                        $data_first = Store::where('city_name',$city_name_key)->where('name_store',$name_store)->orderBy('id','ASC')->first();
                        Plan::where('store_id',$id_store_update)->update([
                            'store_id' => $data_first->id,
                            'old_store_id' => $id_store_update
                        ]);
                        $check_update_for = Store::where('id',$id_store_update)->update([
                            'id_deleted' => $user_info['user_id'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                        if($check_update == 0 && $check_update_for){
                            $check_update = 1;
                        }
                    }
                }
            }
                return response()->json([
                    'status' => 1,
                    'message' => 'Tính năng đang cập nhật vui lòng thông báo cho IT'
                ]);
            // if($check_update){
            //     return response()->json([
            //         'status' => 1,
            //         'message' => 'Update data thành công'
            //     ]);
            // }else{
            //     return response()->json([
            //         'status' => 2,
            //         'message' => 'Không có dữ liệu nào được thay đổi'
            //     ]);
            // }
        //     DB::commit();
        // }catch(Exception $e){
        //     DB::rollBack();
        //     return response()->json([
        //         'status' => 0,
        //         'message' => $e->getMessage()
        //     ]);
        // }
    }
}
