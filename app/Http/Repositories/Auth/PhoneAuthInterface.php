<?php


namespace App\Http\Repositories\Auth;


interface PhoneAuthInterface
{
    public function sendCodeAndReturnUser($user);
    
    public function confirmCode($user_id,$code);

    public function checkPhoneNumberAndPassword($data);

    public function sendCodeByUserId($user_id);

    public function checkPhoneNumberAndSendCode($phone_number);

    public function changePassword($request);

    public function addPhoneNumber($data);

    public function confirmNewPhoneNumber($code);

}
