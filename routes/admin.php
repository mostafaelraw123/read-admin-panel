<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group(
        [
            'prefix' => "admin",
        ], function(){
    /*==================== Auth System  ==================*/
    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AdminLoginController@login')->name('admin.login.submit');


    /*==================== Admin Panel ==================*/





          Config::set('auth.defines', 'admin');



        Route::group(['middleware' => 'admin:admin'], function () {

            /*================LogOut===========*/
            Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');


            Route::get('/home', 'AdminController@index')->name('admin.dashboard');
            Route::get('calender', 'AdminController@calender')->name('admin.calender');

            /*================Admin Setting control =========================*/

            Route::resource('settings','AdminSettingController');//setting

            /*================Admin Contact us control =========================*/

            Route::resource('contacts','AdminContactUsController');

            /*================Admin send firebase control =========================*/

            Route::resource('firebaseNotification','AdminFirebaseNotificationController');

            /*================Admin Profile control =========================*/

            Route::resource('profile','AdminProfileController');

            /*================Admin Admin control =========================*/
            Route::resource('admins','AdminAdminController');
            Route::delete('admins/delete/bulk','AdminAdminController@delete_all')->name('admins.delete.bulk');


            /*================Admin Users control =========================*/

            Route::resource('users','AdminUserController');
            Route::delete('users/delete/bulk','AdminUserController@delete_all')->name('users.delete.bulk');
            Route::get('users/changeBlock/{id}','AdminUserController@changeBlock')
                ->name('users.changeBlock');

            /*================   Notification =========================*/

            Route::resource('notifications','AdminNotifications');
            Route::get('notifications/makeRead/{id}','AdminNotifications@makeRead')->name('makeRead');
            Route::delete('notifications/delete/bulk','AdminNotifications@delete_all')->name('notifications.delete.bulk');
            Route::get('notificationsForLayout','AdminNotifications@notificationsForLayout')->name('notificationsForLayout');

            /*=============Roles and Permissions==============================*/

            Route::resource('permissions','AdminPermissionsController');
            Route::delete('permissions/delete/bulk','AdminPermissionsController@delete_all')->name('permissions.delete.bulk');

            Route::resource('adminPermissions','PermissionForAdminAddingController');
            Route::delete('adminPermissions/delete/bulk','PermissionForAdminAddingController@delete_all')->name('adminPermissions.delete.bulk');


            /*====================End Admin Panel==================*/


        });//end middleware admin


    });

});

