<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index');

    Route::group(['middleware' => ['guest']], function () {

        /*** Register Routes ***/
        Route::get('/register', 'Auth\RegisterController@show')->name('admin.register.show');
        Route::post('/register', 'Auth\RegisterController@register')->name('admin.register.perform');

        /*** Login Routes ***/
        Route::get('/login', 'Auth\LoginController@show')->name('admin.login.show');
        Route::post('/login', 'Auth\LoginController@login')->name('admin.login.perform');

        /*** forgot - reset password ***/
        Route::get('recovery-options', 'Auth\ForgotPasswordController@showRecoveryOptionsForm')->name('recovery.options.get');
        Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
        Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
        Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');
    });

    Route::group(['middleware' => ['auth:admin', 'role:financiero']], function () { });

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/logout', 'Auth\LogoutController@perform')->name('admin.logout.perform');
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

        /*** User Routes ***/
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/edit/{id}', 'UsersController@edit')->name('users.edit');
            Route::put('/update/{id}', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');

            Route::get('/profile/{user}', 'UsersController@showProfile')->name('users.show.profile');
            Route::get('/edit/profile/{id}', 'UsersController@editProfile')->name('users.edit.profile');
            Route::put('/update/profile/{id}', 'UsersController@updateProfile')->name('users.update.profile');
        });

        /*** Partners Routes ***/
        Route::group(['prefix' => 'partners'], function () {
            Route::get('/', 'PartnersController@index')->name('partners.index');
            Route::get('/create', 'PartnersController@create')->name('partners.create');
            Route::post('/create', 'PartnersController@store')->name('partners.store');
            Route::get('/{id}/show', 'PartnersController@show')->name('partners.show');
            Route::get('/edit/{id}', 'PartnersController@edit')->name('partners.edit');
            Route::put('/update/{id}', 'PartnersController@update')->name('partners.update');
            Route::delete('/{id}/delete', 'PartnersController@destroy')->name('partners.destroy');
        });

        Route::resource('roles', 'ACL\RolesController');
        Route::resource('permissions', 'ACL\PermissionsController');
    });
});
