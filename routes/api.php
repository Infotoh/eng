<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TriningController;


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


Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/Consultation', [ConsultationController::class, 'index']);
    Route::get('/Consultation/{id}', [ConsultationController::class,'show']);
    Route::post('/Consultation-store/', [ConsultationController::class,'store2']);
});


Route::post('/Trining', [TriningController::class, 'index']);
Route::post('/Consultation', [ConsultationController::class, 'store']);
Route::post('/user_update', [AuthController::class,'update_user']);
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
