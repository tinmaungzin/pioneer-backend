<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Auth\AuthInterface;
use App\Http\Repositories\Auth\PhoneAuthInterface;
use App\Http\Requests\User\AddUserPhoneNumberRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CheckingUserRequest;
use App\Http\Requests\User\UserRegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private PhoneAuthInterface $phone_auth;
    private AuthInterface $auth;

    public function __construct(PhoneAuthInterface $phoneAuth,AuthInterface $auth){
        $this->phone_auth = $phoneAuth;
        $this->auth = $auth;
    }

    public function login (Request $request){
        return $this->auth->login($request,'admin');
    }

    public function registerWithPhoneNumber(UserRegisterRequest $request){
        $this->phone_auth->sendCodeAndReturnUser($request->all());
    }
    public function confirmCode(CheckingUserRequest $request){
        $auth_user =  $this->phone_auth->confirmCode($request->user_id, $request->code);
        if ($auth_user)
            $data =  $this->auth->setTokenData($auth_user,'user');
        responseData('data',$data,200);
    }

    public function sendCodeByUserId(CheckingUserRequest $request){
        $this->phone_auth->sendCodeByUserId($request->user_id);
    }

    public function forgetPassword(Request $request){
        $this->phone_auth->checkPhoneNumberAndSendCode($request->phone_number);
    }

    public function changePassword(ChangePasswordRequest $request){
        $this->phone_auth->changePassword($request);
    }

    public function addUserPhoneNumber(AddUserPhoneNumberRequest $request){
        $this->phone_auth->addPhoneNumber($request->all());
    }

    public function confirmNewPhoneNumber(Request $request)
    {
        $this->phone_auth->confirmNewPhoneNumber($request->code);
    }
}
