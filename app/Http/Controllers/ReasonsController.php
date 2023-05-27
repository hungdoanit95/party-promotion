<?php

namespace App\Http\Controllers;

use App\Models\ReasonGroups;
use App\Models\Reasons;
use App\Utils\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReasonsController extends Controller
{
    public function index(Request $request){
        $query_data = $request;
        try{
            DB::enableQueryLog();
            $filter_array = [
                'id',
                'type_name',
                'limit',
                'is_require',
                'sort_order'
            ];
            // $reasons = Reasons::with('reasonLists')->orderBy('id', 'DESC');
            $reasons = ReasonGroups::with('reasonLists')->find($query_data['group_id']);
            return response()->json([
                'api_name' => 'Reason List API',
                'data' => $reasons,
                'query_params' => $query_data['group_id'],
                'status' => 1
            ],200);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => Messages::MSG_0018], 500);
        }
    }
}
