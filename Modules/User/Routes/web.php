<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\QrCodeController;

Route::prefix('user')->group(function () {

    Route::get('/', 'HomeController@index');

    Route::group(['middleware' => ['guest']], function () {

        /*** Register Routes ***/
        Route::get('/register', 'Auth\RegisterController@show')->name('register.show');
        Route::post('/register', 'Auth\RegisterController@register')->name('register.perform');

        /*** Login Routes ***/
        Route::get('/login', 'Auth\LoginController@show')->name('login.show');
        Route::post('/login', 'Auth\LoginController@login')->name('login.perform');

        /*** forgot - reset password ***/
        Route::get('/recovery-options', 'Auth\ForgotPasswordController@showRecoveryOptionsForm')->name('user.recovery.options.get');
        Route::get('/forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('user.forget.password.get');
        Route::post('/forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('user.forget.password.post');
        Route::get('/reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('user.reset.password.get');
        Route::post('/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('user.reset.password.post');
    });

    Route::group(['middleware' => ['auth:web']], function () {

        Route::get('/dashboard', 'HomeController@index')->name('user.dashboard');
        Route::get('/logout', 'Auth\LogoutController@perform')->name('logout.perform');

        /*** User Routes ***/
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('users.index');
            Route::get('/create', 'UserController@create')->name('users.create');
            Route::post('/create', 'UserController@store')->name('users.store');
            Route::get('/{user}/show', 'UserController@show')->name('users.show');
            Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
            Route::put('/update/{id}', 'UserController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UserController@destroy')->name('users.destroy');

            Route::get('/profile/{user}', 'UserController@showProfile')->name('users_.show.profile');
            Route::get('/edit/profile/{id}', 'UserController@editProfile')->name('users_.edit.profile');
            Route::put('/update/profile/{id}', 'UserController@updateProfile')->name('users_.update.profile');
        });

        /*** Reports Routes ***/
        Route::resource('/reports', 'ReportsController');

        /*** Notifications Routes ***/
        Route::resource('/notifications', 'NotificationsController');

        /*** ACL Routes ***/
        Route::resource('roles', 'ACL\RolesController');
        Route::resource('permissions', 'ACL\PermissionsController');

        /** Machines Routes*/
        Route::group(['prefix' => 'machines'], function () {
            Route::get('/createPDF', 'MachinesController@createPDF')->name('machines.createPDF');
            Route::get('/', 'MachinesController@index')->name('machines.index');
            Route::get('/grid_view', 'MachinesController@grid_view')->name('machines.grid_view');
            
            Route::get('/grid_view_api', 'MachinesController@grid_view_api')->name('machines.grid_view_api');

            Route::get('/create', 'MachinesController@create')->name('machines.create');
            Route::post('/create', 'MachinesController@store')->name('machines.store');
            Route::get('/{user}/show', 'MachinesController@show')->name('machines.show');
            Route::get('/edit/{id}', 'MachinesController@edit')->name('machines.edit');
            Route::put('/update/{id}', 'MachinesController@update')->name('machines.update');
            Route::delete('/{user}/delete', 'MachinesController@destroy')->name('machines.destroy');

            Route::any('/search_list', 'MachinesController@search_list')->name('machines.search_list');
            Route::any('/search_gridview', 'MachinesController@search_gridview')->name('machines.search_gridview');
        });

        /** Customers Routes*/
        Route::resource('/customers', 'CustomersController');

        /** Posts */
        Route::get('posts','PostController@index')->name('posts.index');
        Route::any('posts/search', 'PostController@search')->name('posts.search');

    });
});
