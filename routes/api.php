<?php

use App\Http\Controllers\StaffController;
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
    //Route::get('download_image/{image_name}',[UserProfileController::class,'downloadImage']);
});

Route::post('user/login',[LoginController::class,'getUserLogin']);
Route::post('salesperson/login',[LoginController::class,'getSalespersonLogin']);
Route::post('receptionist/login',[LoginController::class,'getReceptionistLogin']);
Route::post('admin/login',[LoginController::class,'getAdminLogin']);



Route::group(['middleware' =>['auth:sanctum','type.user'],'prefix'=>'user'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
});
Route::group(['prefix'=>'admin'], function () {
    Route::resource('staffs',StaffController::class);
});



Route::group(['middleware' =>['auth:sanctum','type.admin'],'prefix'=>'admin'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
});

Route::group(['middleware' =>['auth:sanctum','type.receptionist'],'prefix'=>'receptionist'], function () {
    Route::get('/',[UserController::class,'getAuthUser']);
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
});
