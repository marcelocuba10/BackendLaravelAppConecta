<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\GroundApiController;
use Modules\User\Http\Controllers\Api\ReportApiController;
use Modules\User\Http\Controllers\OrderController;

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

Route::group(['prefix' => 'auth'], function () {

    Route::group(['middleware' => ['guest']], function () {
        Route::post('login', 'Api\Auth\AuthController@login')->name('login');
        //Route::post('register', 'Api\Auth\AuthController@register');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Api\Auth\AuthController@logout');
        Route::get('user', 'Api\Auth\AuthController@user');
    });

});

Route::middleware(['cors'])->group(function () {
    Route::resource('orders','OrderController');

    Route::get('grounds',[GroundApiController::class,'index']);
    Route::get('grounds/{id}',[GroundApiController::class,'edit']);

    Route::get('reports',[ReportApiController::class,'index']);
    Route::get('report/{id}',[ReportApiController::class,'edit']);
    Route::get('report/user/{id}',[ReportApiController::class,'getReportsByUser']);
    Route::post('report', [ReportApiController::class,'store']);
});