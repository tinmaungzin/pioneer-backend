<?php

namespace App\Http\Repositories\Auth;

use App\Http\Actions\SMSPoh\SMSVerification;
use App\Http\Services\User\UserFacade;
use Illuminate\Support\Facades\Hash;

class PhoneAuthRepository implements PhoneAuthInterface
{
    public function sendCodeAndReturnUser($data){
        $data ['verify_code'] = RandomDigits() ;
        $user = UserFacade::create($data);
        $is_send_code = $this->sendCodeBySMS($user);
        return  ($is_send_code ) ? responseData('user_id', $user->id, 200) : responseFalse();
    }

    public function confirmCode($user_id, $code){
        $data =[ ['id',$user_id],['verify_code',$code] ];
        $user = UserFacade::findUser($data);
        if($user){
            $user->update([
                'is_verified' => 1
            ]);
           return $user;
        }
        responseStatus('Code Invalid', 401);
    }

    public function checkPhoneNumberAndPassword($data){
        $user = UserFacade::findUser([['phone_number', $data->phone_number]]);
        if ($user) {
            if (Hash::check($data->password, $user->password)) {
                $token =  UserFacade::setUserToken($user);
                $token->auth_user = auth('sanctum')->user();
            } else {
                responseStatus('Password is not correct',422);
            }
        }
        responseStatus('This phone number is not exists',422);
    }

    public function sendCodeByUserId($user_id){
        $user = UserFacade::findUser([['id', $user_id]]);
        $is_send_code = $this->sendCodeBySMS($user);
        return  ($is_send_code ) ? responseStatus('Resend Code to your phone number ',200) : responseFalse();
    }

    public function sendCodeBySMS($user){
        $sms_verify = (new SMSVerification($user));
        $sms_verify->saveVerifyCode();
        return $sms_verify->sendVerifyCode();
    }

    public function checkPhoneNumberAndSendCode($phone_number){
        $user = UserFacade::findUser([['phone_number', $phone_number]]);
        if($user) {
            $is_send_code = $this->sendCodeBySMS($user);
            return ($is_send_code) ? responseData('user_id',$user->id,200): responseFalse();
        }
        responseStatus('This phone number is not exists',422);
    }

    public function changePassword($request){
        $data =[ ['id',$request->user_id] ];
        $user = UserFacade::findUser($data);
        $user->update([
            'password' => $request->password
        ]);
        $user->tokens()->delete();
        return  UserFacade::setUserToken($user);
    }

    public function addPhoneNumber($data)
    {
        $user = UserData();
        $user->update($data);
        $is_send_code = (new PhoneAuthRepository())->sendCodeBySMS($user);
        return  ($is_send_code ) ? responseData('user_id',$user->id,200) : responseFalse();
    }

    public function confirmNewPhoneNumber($code){
        $user = UserData();
        $data =[ ['id',$user->id],['verify_code',$code] ];
        $user = UserFacade::findUser($data);
        if($user){
            $user->update([
                'phone_number' => $user->new_phone_number,
                'new_phone_number' => null
            ]);
            responseTrue('Phone Number is successfully added');
        }
        responseStatus('Code Invalid', 401);
    }
}

