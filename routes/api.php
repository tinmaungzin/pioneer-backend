<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;

Route::group(['prefix'=>'user'], function () {
    Route::post('login',[UserAuthController::class,'login']);
    Route::post('register',[AuthController::class,'registerWithPhoneNumber']);
    Route::post('confirm_code',[AuthController::class,'confirmCode']);
    Route::post('send_code_by_user_id',[AuthController::class,'sendCodeByUserId']);
    Route::post('send_code_by_phone_number',[AuthController::class,'forgetPassword']);
    Route::post('change_password',[AuthController::class,'changePassword']);
    Route::post('social_auth',[AuthController::class,'authWithSocial']);
    //Route::get('download_image/{image_name}',[UserProfileController::class,'downloadImage']);
});

Route::group(['middleware' =>['auth:sanctum','type.user'],'prefix'=>'user'], function () {
    Route::get('users',[UserController::class,'index']);
});
Route::group(['prefix'=>'admin'], function () {
    Route::resource('staffs',StaffController::class);
});



