<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Đăng nhập
Route::post('/login', \App\Http\Controllers\UsersController::class)->name('login');

//Time Server

Route::get('/times_server', [\App\Http\Controllers\CameraController::class,'times_server']);

//List cameras
Route::get('/camera_types', [\App\Http\Controllers\CameraController::class,'index']);

//List Lý do TC/KTC
Route::get('/reasons/{group_id}', [\App\Http\Controllers\ReasonsController::class,'index']);

//List Lý do nghỉ phép
Route::get('/get_absences', [\App\Http\Controllers\UsersController::class, 'get_absences']);

//List các Bộ câu hỏi khảo sát
Route::get('/surveys', [\App\Http\Controllers\SurveysController::class,'index']);

//List Plan của Nhân viên
Route::middleware('verify.api')->prefix('plans')->group(function () {
    Route::post('/', [\App\Http\Controllers\PlansController::class,'index']);
    Route::post('/get_plan_by_id', [\App\Http\Controllers\PlansController::class,'get_plan_by_id']);
    Route::post('/dashboard', [\App\Http\Controllers\PlansController::class,'get_dashboard']);
    Route::post('/get_search_plan', [\App\Http\Controllers\PlansController::class,'get_search_plan']);
    Route::post('/get_detail_plan', [\App\Http\Controllers\PlansController::class,'get_detail_plan']);
    Route::post('/add_plan', [\App\Http\Controllers\PlansController::class,'add_plan']);
    Route::post('/add_note', [\App\Http\Controllers\PlansController::class,'add_note']);
    Route::post('/update_reason', [\App\Http\Controllers\PlansController::class, 'update_reason']);
    Route::post('/update_status_plan', [\App\Http\Controllers\PlansController::class, 'update_status_plan']);
    Route::post('/update_store_info', [\App\Http\Controllers\StoresController::class, 'update_store_info']);
    Route::post('/get_data_survey', [\App\Http\Controllers\SurveysController::class, 'get_data_survey']);
    Route::post('/get_data_reason', [\App\Http\Controllers\PlansController::class, 'get_data_reason']);
    Route::post('/get_store_info_by_plan_id', [\App\Http\Controllers\StoresController::class,'get_store_info_by_plan_id']);
    Route::post('/update_info_user', [\App\Http\Controllers\UsersController::class,'update_info_user']);
    Route::post('/get_info_user', [\App\Http\Controllers\UsersController::class,'get_info_user']);
});

Route::middleware('verify.api')->prefix('party')->group(function () {
    Route::post('/get_parties_survey', [\App\Http\Controllers\PartyController::class, 'getPartiesSurvey']);
    Route::post('/get_parties', [\App\Http\Controllers\PartyController::class, 'getPartiesByUserIdMobile']);
    Route::post('/get_planparty_by_id', [\App\Http\Controllers\PartyController::class,'getPlanPartyById']);
    Route::post('/update_plan_checkin', [\App\Http\Controllers\PartyController::class, 'updatePlanCheckIn']);
    Route::post('/update_barcode_plan', [\App\Http\Controllers\BarcodePlanController::class, 'updateBarcodePlan']);
    Route::post('/add_party_note', [\App\Http\Controllers\PartyController::class, 'add_party_note']);
}); 

//List Local
Route::prefix('local')->group(function () {
    Route::get('/provinces', [\App\Http\Controllers\ProvincesController::class,'get_list_provinces']);
    Route::get('/districts', [\App\Http\Controllers\ProvincesController::class,'get_list_districts']);
    Route::get('/wards', [\App\Http\Controllers\ProvincesController::class,'get_list_wards']);
});

//Upload Data
Route::middleware('verify.api')->prefix('uploads')->group(function(){
    Route::post('/absence_reasons', [\App\Http\Controllers\UsersController::class,'absence_reasons']);
    Route::post('/checkin', [\App\Http\Controllers\PlansController::class,'checkin']);
    Route::post('/checkin_party', [\App\Http\Controllers\PlansController::class,'checkinParty']);
    Route::post('/plan_images', [\App\Http\Controllers\PlansController::class,'upload_plan_images']);
    Route::post('/update_plan_surveys', [\App\Http\Controllers\PlansController::class,'upload_plan_surveys']);
});