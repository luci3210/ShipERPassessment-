<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErpController;

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

Route::post('/save/',[ErpController::class, 'erp_create']);
Route::get('/erpdetails/',[ErpController::class, 'erp_details']);
Route::get('/erpedit/{id}',[ErpController::class, 'erp_edit']);
Route::put('/erpupdate/{id}',[ErpController::class, 'erp_update']);
Route::delete('/erpdelete/{id}',[ErpController::class, 'erp_delete']);


