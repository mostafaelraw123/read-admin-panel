<?php


//api

//================== Helper links ===================

Route::get('allGovernorates', 'Helper\ApiHelperController@all_Governorates');
Route::post('citiesByGovernorateId', 'Helper\ApiHelperController@cities_by_governorate_id');

//============== auth system links ===================

Route::post('login', 'Auth\ApiAuthController@login');
Route::post('register', 'Auth\ApiAuthController@register');
Route::post('getUserByPhone', 'Auth\ApiAuthController@getUserByPhone');
Route::post('logout', 'Auth\ApiAuthController@logout');


//============= Home Links ===========================
//البانر
Route::get('sliders','Pages\Home\Slider\ApiSliderController@sliders');
Route::post('singleProduct','Pages\Home\Slider\ApiSliderController@single_product');

//نقاطى بالفلتر
Route::get('getMyPoints','Pages\Home\MyPoints\ApiMyPointsController@getMyPoints');

//الجوائز
Route::get('getAllPrizes','Pages\Home\Prizes\ApiPrizesController@getAllPrizes');
Route::post('changePointWithPrize','Pages\Home\Prizes\ApiPrizesController@changePointWithPrize');

//معارض الألوان
Route::get('getAllColorShows','Pages\Home\ColorShows\ApiColorShowsController@getAllColorShows');
Route::post('singleColorShow','Pages\Home\ColorShows\ApiColorShowsController@singleColorShow');

//الأقسام

Route::get('allCategories','Pages\Home\Categories\ApiCategoriesController@allCategories');
Route::post('getProductsByCategoryId','Pages\Home\Categories\ApiCategoriesController@getProductsByCategoryId');


//================== Qrcode links ===================

//مسح Qrcode
Route::post('MakeQrcodeScanRequest','Pages\Qrcodes\ApiQrcodesController@makeQrcodeScanRequest');


//================== profile links ===================

//profile
Route::get('getCurrentUserData', 'Pages\Profile\ApiProfileController@getCurrentUserData');
Route::post('updateProfile', 'Pages\Profile\ApiProfileController@updateProfile');


//================== Notification links ===================

Route::get('allNotifications','ApiNotificationsController@allNotifications');
Route::get('unReadNotificationsCount', 'ApiNotificationsController@unReadNotificationsCount');
Route::post('deleteNotification', 'ApiNotificationsController@deleteNotification');

//================== Settings links ===================

//phone token
Route::post('firebase-tokens', 'TokenController@token_update');
Route::post('firebase/token/delete', 'TokenController@token_delete');
//setting
Route::get('app/info', 'ApiSettingController@app_information');
Route::post('contactUs', 'ContactController@contact_us')->name('contactUsFromApi');

