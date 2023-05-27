<?php

namespace App\Http\Controllers;

use App\Models\CameraType;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function index(){
        // $cameras = CameraType::where('id', 1)->get(['type_name','limit','is_require']);
        $filter_array = [
            'id',
            'type_name',
            'type_option',
            'limit',
            'is_require',
            'sort_order'
        ];
        $cameras = CameraType::all($filter_array);
        return response()->json([
            'api_name' => 'Camera List API',
            'data' => $cameras,
            'status' => 1
        ],200);
    }

    public function times_server(){
        $data_times = [
            'date_times_data' => date('Y-m-d H:i:s'),
            'times_data'=> time()
        ];
        return response()->json([
            'api_name' => 'Times Server API',
            'data' => $data_times,
            'status' => 1
        ],200);
    }
}
