<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index');

    Route::group(['middleware' => ['guest']], function () {

        /** CronJob */
        Route::get('/machines/cron', 'MachinesController@cronjob')->name('machines.cronjob.index');

        /*** Register Routes ***/
        // Route::get('/register', 'Auth\RegisterController@show')->name('admin.register.show');
        // Route::post('/register', 'Auth\RegisterController@register')->name('admin.register.perform');

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

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/logout', 'Auth\LogoutController@perform')->name('admin.logout.perform');
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

        /*** User Routes ***/
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/show/{id}', 'UsersController@show')->name('users.show');
            Route::get('/edit/{id}', 'UsersController@edit')->name('users.edit');
            Route::put('/update/{id}', 'UsersController@update')->name('users.update');
            Route::delete('/delete/{id}', 'UsersController@destroy')->name('users.destroy');

            Route::get('/profile/{id}', 'UsersController@showProfile')->name('users.show.profile');
            Route::get('/edit/profile/{id}', 'UsersController@editProfile')->name('users.edit.profile');
            Route::put('/update/profile/{id}', 'UsersController@updateProfile')->name('users.update.profile');
            Route::get('/search', 'UsersController@search')->name('users.search');
        });

        /*** Customers Routes ***/
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', 'CustomersController@index')->name('customers.index');
            Route::get('/create', 'CustomersController@create')->name('customers.create');
            Route::post('/create', 'CustomersController@store')->name('customers.store');
            Route::get('/show/{id}', 'CustomersController@show')->name('customers.show');
            Route::get('/edit/{id}', 'CustomersController@edit')->name('customers.edit');
            Route::put('/update/{id}', 'CustomersController@update')->name('customers.update');
            Route::delete('/delete/{id}', 'CustomersController@destroy')->name('customers.destroy');
            Route::get('/search', 'CustomersController@search')->name('customers.search');
        });

        /*** Notifications Routes ***/
        Route::group(['prefix' => 'notifications'], function () {
            Route::get('/', 'NotificationsController@index')->name('notifications.index');
            Route::get('/create', 'NotificationsController@create')->name('notifications.create');
            Route::post('/create', 'NotificationsController@store')->name('notifications.store');
            Route::get('/show/{id}', 'NotificationsController@show')->name('notifications.show');
            Route::get('/edit/{id}', 'NotificationsController@edit')->name('notifications.edit');
            Route::put('/update/{id}', 'NotificationsController@update')->name('notifications.update');
            Route::delete('/delete/{id}', 'NotificationsController@destroy')->name('notifications.destroy');
            Route::get('/search', 'NotificationsController@search')->name('notifications.search');
        });

        /*** Plans Routes ***/
        Route::group(['prefix' => 'plans'], function () {
            Route::get('/', 'PlansController@index')->name('plans.index');
            Route::get('/create', 'PlansController@create')->name('plans.create');
            Route::post('/create', 'PlansController@store')->name('plans.store');
            Route::get('/show/{id}', 'PlansController@show')->name('plans.show');
            Route::get('/edit/{id}', 'PlansController@edit')->name('plans.edit');
            Route::put('/update/{id}', 'PlansController@update')->name('plans.update');
            Route::delete('/delete/{id}', 'PlansController@destroy')->name('plans.destroy');
            Route::get('/search', 'PlansController@search')->name('plans.search');
        });

        /*** Financial Routes ***/
        Route::group(['prefix' => 'financial'], function () {
            Route::get('/', 'FinancialController@index')->name('financial.index');
            Route::get('/create', 'FinancialController@create')->name('financial.create');
            Route::post('/create', 'FinancialController@store')->name('financial.store');
            Route::get('/show/{id}', 'FinancialController@show')->name('financial.show');
            Route::get('/edit/{id}', 'FinancialController@edit')->name('financial.edit');
            Route::put('/update/{id}', 'FinancialController@update')->name('financial.update');
            Route::delete('/delete/{id}', 'FinancialController@destroy')->name('financial.destroy');
            Route::get('/search', 'FinancialController@search')->name('financial.search');
        });

        /*** ACL Routes ***/
        Route::group(['prefix' => 'ACL'], function () {
            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', 'ACL\RolesController@index')->name('roles.admin.index');
                Route::get('/create', 'ACL\RolesController@create')->name('roles.admin.create');
                Route::post('/create', 'ACL\RolesController@store')->name('roles.admin.store');
                Route::get('/show/{id}', 'ACL\RolesController@show')->name('roles.admin.show');
                Route::get('/edit/{id}', 'ACL\RolesController@edit')->name('roles.admin.edit');
                Route::put('/update/{id}', 'ACL\RolesController@update')->name('roles.admin.update');
                Route::delete('/delete/{id}', 'ACL\RolesController@destroy')->name('roles.admin.destroy');
                Route::get('/search', 'ACL\RolesController@search')->name('roles.admin.search');
            });

            Route::group(['prefix' => 'permissions'], function () {
                Route::get('/', 'ACL\PermissionsController@index')->name('permissions.admin.index');
                Route::any('/get', 'ACL\PermissionsController@getPermissions')->name('permissions.admin.getPermissions');
                Route::get('/create', 'ACL\PermissionsController@create')->name('permissions.admin.create');
                Route::post('/create', 'ACL\PermissionsController@store')->name('permissions.admin.store');
                Route::get('/show/{id}', 'ACL\PermissionsController@show')->name('permissions.admin.show');
                Route::get('/edit/{id}', 'ACL\PermissionsController@edit')->name('permissions.admin.edit');
                Route::put('/update/{id}', 'ACL\PermissionsController@update')->name('permissions.admin.update');
                Route::delete('/delete/{id}', 'ACL\PermissionsController@destroy')->name('permissions.admin.destroy');
                Route::get('/search', 'ACL\PermissionsController@search')->name('permissions.admin.search');
            });
        });
    });
});
