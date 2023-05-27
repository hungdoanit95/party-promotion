<?php

namespace App\Http\Controllers;

use App\Models\AbsenceReasons;
use App\Models\Absences;
use Illuminate\Http\Request;

class AbsencesController extends Controller
{
    public function index(){
        $absences = AbsenceReasons::with('reasonLists')->get();
        return response()->json([
            'api_name' => 'Absences Api'
        ],200);
    }
    public function get_absences(){
        $absences_list = AbsenceReasons::select('reason_name,sort_order')->get();
        return response()->json([
            'api_name' => 'Absences Api',
            'data' => $absences_list,
            'status' => 1
        ],200);
    }
}
