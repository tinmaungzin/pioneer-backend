<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PointItemController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\SetTypeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LoginController;

Route::group(['prefix'=>'user'], function () {
    Route::post('register',[AuthController::class,'registerWithPhoneNumber']);
    Route::post('confirm_code',[AuthController::class,'confirmCode']);
    Route::post('send_code_by_user_id',[AuthController::class,'sendCodeByUserId']);
    Route::post('send_code_by_phone_number',[AuthController::class,'forgetPassword']);
    Route::post('change_password',[AuthController::class,'changePassword']);
    Route::post('social_auth',[AuthController::class,'authWithSocial']);
});

Route::post('user/login',[LoginController::class,'getUserLogin']);
Route::post('salesperson/login',[LoginController::class,'getSalespersonLogin']);
Route::post('receptionist/login',[LoginController::class,'getReceptionistLogin']);
Route::post('admin/login',[LoginController::class,'getAdminLogin']);



Route::group(['middleware' =>['auth:sanctum','type.user'],'prefix'=>'user'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);


});


Route::group(['middleware' =>['auth:sanctum','type.admin'],'prefix'=>'admin'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
    Route::resource('staffs',StaffController::class);
    Route::post('/staffs/{staff}/change_password',[StaffController::class,'changePassword']);

    Route::resource('types',TypeController::class);
    Route::resource('packages',PackageController::class);
    Route::get('all_types', [PackageController::class, 'getAllTypes']);
    Route::get('all_sets', [PackageController::class, 'getAllSets']);

    Route::resource('sets',SetController::class);
    Route::resource('point_items',PointItemController::class);
    Route::resource('set_types', SetTypeController::class);

    Route::resource('users',UserController::class);
    Route::post('/users/{user}/change_password',[UserController::class,'changePassword']);
    Route::resource('events',EventController::class);
    Route::get('all_tables', [EventController::class, 'getAllTables']);


});

Route::group(['middleware' =>['auth:sanctum','type.receptionist'],'prefix'=>'receptionist'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
    Route::get('available_events', [EventController::class, 'availableEvents']);
    Route::resource('bookings', BookingController::class);
    Route::post("bookingByEventTableId", [BookingController::class, "getBookingByEventTableId"]);
});

Route::group(['middleware' =>['auth:sanctum','type.salesperson'],'prefix'=>'salesperson'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);

});

Route::group(['middleware' =>['auth:sanctum','type.all'],'prefix'=>'all'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
});

Route::group(['middleware' =>['auth:sanctum','type.staff'],'prefix'=>'staff'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
});

Route::group(['middleware' =>['auth:sanctum','type.sales_user'],'prefix'=>'sales_user'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
    Route::post('/users/{user}/change_password',[UserController::class,'changePassword']);
    Route::resource('bookings', BookingController::class, ['as' => 'user_bookings']);

});

Route::get('available_events', [EventController::class, 'availableEvents']);
Route::get('download_image/{image_name}',[\App\Http\Controllers\ImageController::class,'downloadImage']);

