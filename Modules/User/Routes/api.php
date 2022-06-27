<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\MachineApiController;
use Modules\User\Http\Controllers\Api\NotificationApiController;
use Modules\User\Http\Controllers\Api\ReportApiController;


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

    /** Routes Reports */
    Route::get('reports',[ReportApiController::class,'index']);
    Route::put('report/{id}', [ReportApiController::class,'update']);
    Route::get('report/{id}',[ReportApiController::class,'edit']);
    Route::get('report/user/{id}',[ReportApiController::class,'getReportsByUser']);
    Route::post('report', [ReportApiController::class,'store']);
    Route::get('report/user/check/{id}', [ReportApiController::class,'checkReport']);
    Route::delete('report/{id}', [ReportApiController::class,'destroy']);

    /** Routes Notifications */
    Route::get('notifications',[NotificationApiController::class,'index']);

    /** Routes Machines */
    Route::get('machines',[MachineApiController::class,'index']);
    Route::get('machine/{id}',[MachineApiController::class,'edit']);
    Route::put('machine/{id}', [MachineApiController::class,'update']);
    Route::post('machine', [MachineApiController::class,'store']);

});