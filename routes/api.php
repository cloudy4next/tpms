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


Route::post('edi-data', [\App\Http\Controllers\API\EdiController::class, 'send_edi_data']);
Route::get('/v1/meet/{meet_id}', [\App\Http\Controllers\API\MeetController::class, 'show_meet_url']);
Route::get('/v1/meet-end/{meet_id}', [\App\Http\Controllers\API\MeetController::class, 'end_meet']);


//admin login

Route::post('/v1/admin/login', [\App\Http\Controllers\API\Auth\AdminLoginController::class, 'admin_login']);

Route::group(['middleware' => ['auth:admin-api']], function () {
    Route::prefix('v1/admin')->group(function () {

        //get clients
        Route::get('/get/clients', [\App\Http\Controllers\API\Admin\AdminClientController::class, 'get_clients']);
        Route::get('/get/client/{id}', [\App\Http\Controllers\API\Admin\AdminClientController::class, 'get_clients_by_id']);

        //get provider
        Route::get('/get/providers', [\App\Http\Controllers\API\Admin\AdminProviderController::class, 'get_provider']);
        Route::get('/get/provider/{id}', [\App\Http\Controllers\API\Admin\AdminProviderController::class, 'get_provider_by_id']);

        //appoinment
        Route::post('/get/appoinments', [\App\Http\Controllers\API\Admin\AdminAppoinmentsController::class, 'get_appoinments']);
        Route::post('/update/appoinments', [\App\Http\Controllers\API\Admin\AdminAppoinmentsController::class, 'update_appoinments']);


        //---------------tpms react api ------------------

        //get clients
        Route::get('/ac/patient', [\App\Http\Controllers\API\Admin\AdminClientController::class, 'ac_get_clients']);
        Route::get('/ac/patient/info/{id}', [\App\Http\Controllers\API\Admin\AdminClientController::class, 'ac_get_clients_by_id']);


        //setting name & location
        Route::get('/ac/get/setting/name/location', [\App\Http\Controllers\API\Admin\AdminSettingController::class, 'ac_get_setting_name_location']);
        Route::post('/ac/update/setting/name/location', [\App\Http\Controllers\API\Admin\AdminSettingController::class, 'ac_update_setting_name_location']);


    });
});


//billerlog user
Route::post('/v1/billerlog/login', [\App\Http\Controllers\API\Auth\BillerLoginController::class, 'biller_login']);

Route::group(['middleware' => ['auth:billerlog-api']], function () {
    Route::prefix('v1/billerlog')->group(function () {

        //get facility
        Route::get('/get/facility', [\App\Http\Controllers\API\Billerlog\BillerlogLedgerController::class, 'get_facility']);

        //get client
        Route::get('/get/client/{fac_id}', [\App\Http\Controllers\API\Billerlog\BillerlogLedgerController::class, 'get_client']);

        //ledger data
        Route::post('/get/ledger/data', [\App\Http\Controllers\API\Billerlog\BillerlogLedgerController::class, 'get_ledger_data']);

        //ledger data transaction
        Route::post('/get/ledger/transaction/data', [\App\Http\Controllers\API\Billerlog\BillerlogLedgerController::class, 'get_ledger_tran_data']);

        //ledger note add
        Route::post('/ledger/single/note/add', [\App\Http\Controllers\API\Billerlog\BillerlogLedgerController::class, 'ledger_single_note_add']);

        // get ledger note
        Route::post('/ledger/note/get/{id}', [\App\Http\Controllers\API\Billerlog\BillerlogLedgerController::class, 'ledger_note_get']);
    });
});
