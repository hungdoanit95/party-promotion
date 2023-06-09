<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/user-import-export', [\App\Http\Controllers\ImportController::class, 'userImportExport']);
Route::post('/user-import',  [\App\Http\Controllers\ImportController::class, 'userImport'])->name('user-import');
Route::get('user-export', [\App\Http\Controllers\ImportController::class, 'userExport'])->name('user-export');

Route::get('/plan-import-export', [\App\Http\Controllers\ImportController::class, 'planImportExport']);
Route::post('/plan-import',  [\App\Http\Controllers\ImportController::class, 'planImport'])->name('plan-import');
Route::get('plan-export', [\App\Http\Controllers\ImportController::class, 'planExport'])->name('plan-export');

Route::get('/store-import-export', [\App\Http\Controllers\ImportController::class, 'storeImportExport']);
Route::post('/store-import',  [\App\Http\Controllers\ImportController::class, 'storeImport'])->name('store-import');
Route::get('/store-export', [\App\Http\Controllers\ImportController::class, 'storeExport'])->name('store-export');

Route::get('/party-import-export', [\App\Http\Controllers\ImportController::class, 'partyImportExport']);
Route::post('/party-import',  [\App\Http\Controllers\ImportController::class, 'partyImport'])->name('party-import');
Route::get('/party-export', [\App\Http\Controllers\ImportController::class, 'partyExport'])->name('party-export');

Route::get('/plan-party-import-export', [\App\Http\Controllers\ImportController::class, 'planPartyImportExport']);
Route::post('/plan-party-import',  [\App\Http\Controllers\ImportController::class, 'planPartyImport'])->name('plan-party-import');
Route::get('/plan-party-export', [\App\Http\Controllers\ImportController::class, 'planPartyExport'])->name('plan-party-export');

Route::get('/get-list-plans', [\App\Http\Controllers\PlansController::class, 'getListPlans'])->name('get-list-plans');
Route::get('/get-info-plan/{id}', [\App\Http\Controllers\PlansController::class, 'getDetailPlan'])->name('get-info-plan');
Route::get('/live-search', [\App\Http\Controllers\PlansController::class, 'liveSearch'])->name('live.search');
Route::post('/confirm-qc-plan', [\App\Http\Controllers\PlansController::class, 'confirmQcPlan'])->name('confirm.qc.plan');
Route::post('update-plan-data', [\App\Http\Controllers\PlansController::class, 'updatePlanData'])->name('update-plan-data');
Route::post('update-detail-plan-web', [\App\Http\Controllers\PlansController::class, 'updateDetailPlanWeb'])->name('update.detail.plan.web');




Route::get('/get-list-plans-party', [\App\Http\Controllers\PartyController::class, 'getListPlansParty'])->name('get-list-plans-party');
Route::get('/get-info-plan-party/{id}', [\App\Http\Controllers\PartyController::class, 'getDetailPlan'])->name('get-info-plan-party');
Route::get('/live-search-party', [\App\Http\Controllers\PartyController::class, 'liveSearchParty'])->name('live.search.party');
Route::post('/confirm-qc-plan-party', [\App\Http\Controllers\PartyController::class, 'confirmQcPlanParty'])->name('confirm.qc.plan.party');
Route::get('/get-party-list', [\App\Http\Controllers\PartyController::class, 'getParties'])->name('get-party-list');
Route::post('update-detail-plan-party', [\App\Http\Controllers\PartyController::class, 'updateDetailPlanParty'])->name('update.detail.plan.party');

Route::post('/upload-image-plan-party', [\App\Http\Controllers\PartyController::class, 'uploadImagePlanParty'])->name('upload.image.plan.party');
Route::get('/fetch-image-party', [\App\Http\Controllers\PartyController::class, 'fetchImage'])->name('fetch.image.party');
Route::post('/delete-image-party', [\App\Http\Controllers\PartyController::class, 'deleteImage'])->name('delete.image.party');
Route::post('/update-image-data-party', [\App\Http\Controllers\PartyController::class, 'updateImageData'])->name('update.image.data.party');
Route::post('/update-type-image-party', [\App\Http\Controllers\PartyController::class,'updateTypeImage'])->name('update.status.image.party');
Route::post('/update-report-plan-party', [\App\Http\Controllers\PartyController::class, 'updateReportPlan'])->name('update.report.plan.party');
Route::post('/update-plan-note-party', [\App\Http\Controllers\PartyController::class, 'updatePlanNote'])->name('update.plan.note.party');
Route::post('/update-status-plan-note-party', [\App\Http\Controllers\PartyController::class, 'updateStatusPlanNote'])->name('update.status.plan.note.party');
Route::post('/update-qc-code-party', [\App\Http\Controllers\PartyController::class, 'updateQcCode'])->name('update.qc.code.party');
Route::post('/delete-plan-party', [\App\Http\Controllers\PartyController::class, 'deletePlan'])->name('delete.plan.party');
Route::get('/transfer-plan-party', [\App\Http\Controllers\PartyController::class, 'transferPlanParty'])->name('transfer.plan.party');
Route::post('/update-transfer-plan-party', [\App\Http\Controllers\PartyController::class, 'updateTransferPlanParty'])->name('update.transfer.plan.party');
Route::post('/re-calculate-result-party', [\App\Http\Controllers\PartyController::class, 'reCalculateResult'])->name('re.calculate.result.party');









Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::get('/get-store-list', [\App\Http\Controllers\StoresController::class, 'getStores'])->name('get-store-list');
Route::post('/update-overview-stores', [\App\Http\Controllers\StoresController::class, 'updateOverviewStores'])->name('update-overview-stores');
Route::post('/group-store-code', [\App\Http\Controllers\StoresController::class, 'groupStoreCode'])->name('group-store-code');

//Download
Route::get('/download-plan-page', [\App\Http\Controllers\DownloadController::class, 'downloadPlanPage'])->name('download-plan-page');
Route::get('/download-plan-party-page', [\App\Http\Controllers\DownloadController::class, 'downloadPlanPartyPage'])->name('download-plan-party-page');
Route::get('/download-user-page', [\App\Http\Controllers\DownloadController::class, 'downloadUserPage'])->name('download-user-page');
Route::get('/download-store-page', [\App\Http\Controllers\DownloadController::class, 'downloadStorePage'])->name('download-store-page');
Route::get('/download-report-plan', [\App\Http\Controllers\DownloadController::class, 'downloadReportPlan'])->name('download-report-plan');
Route::get('/download-powerpoint', [\App\Http\Controllers\DownloadController::class, 'downloadPowerpoint'])->name('download-powerpoint');
Route::get('/download-party', [\App\Http\Controllers\DownloadController::class, 'downloadPartyPage'])->name('download-party');

//Upload Image
Route::post('/upload-image-plan-web', [\App\Http\Controllers\PlansController::class, 'uploadImagePlanWeb'])->name('upload.imagePlanWeb');
Route::get('/fetch-image', [\App\Http\Controllers\PlansController::class, 'fetchImage'])->name('fetch.image');
Route::post('/delete-image', [\App\Http\Controllers\PlansController::class, 'deleteImage'])->name('delete.image');
Route::post('/update-image-data', [\App\Http\Controllers\PlansController::class, 'updateImageData'])->name('update.image.data');
Route::post('/update-type-image', [\App\Http\Controllers\PlansController::class,'updateTypeImage'])->name('update.status.image');
Route::post('/update-report-plan', [\App\Http\Controllers\PlansController::class, 'updateReportPlan'])->name('update.report.plan');
Route::post('/update-plan-note', [\App\Http\Controllers\PlansController::class, 'updatePlanNote'])->name('update.plan.note');
Route::post('/update-status-plan-note', [\App\Http\Controllers\PlansController::class, 'updateStatusPlanNote'])->name('update.status.plan.note');
Route::post('/update-qc-code', [\App\Http\Controllers\PlansController::class, 'updateQcCode'])->name('update.qc.code');
Route::post('/delete-plan', [\App\Http\Controllers\PlansController::class, 'deletePlan'])->name('delete.plan');
Route::get('/transfer-plan', [\App\Http\Controllers\PlansController::class, 'transferPlan'])->name('transfer.plan');
Route::post('/update-transfer-plan', [\App\Http\Controllers\PlansController::class, 'updateTransferPlan'])->name('update.transfer.plan');
Route::post('/re-calculate-result', [\App\Http\Controllers\PlansController::class, 'reCalculateResult'])->name('re.calculate.result');
Route::get('/map-view', [\App\Http\Controllers\MapController::class, 'index'])->name('map.view');

//Login Pages    
Route::get('/',  [\App\Http\Controllers\AuthController::class, 'login'])->name('login.page');
Route::get('/logout',  [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout.page');
Route::post('/check-login',  [\App\Http\Controllers\AuthController::class, 'checkLogin'])->name('check.login');

//User Pages
Route::get('/profile', [\App\Http\Controllers\AuthController::class, 'profile'])->name('profile.page');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout.page');

Route::get('/view-chart', [\App\Http\Controllers\ChartController::class, 'viewChart'])->name('view.chart');