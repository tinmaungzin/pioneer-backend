<?php

namespace App\Http\Actions\SMSPoh;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class SMSVerification
{
    private $user;
    public function __construct($user){
        $this->user = $user;
    }

    public function saveVerifyCode(){
        $code = $this->generateVerifyCode();
        $this->user->verify_code= $code;
        $this->user->save();
    }

    public function sendVerifyCode(){
        $verify_code = $this->user->verify_code;
        $phone =(  $this->user->new_phone_number) ?  : $this->user->phone_number;
        $key = Config::get('app.smspoh');
        $client = new Client();
        $message = "Your+verification+code+for+Pioneer+is+ +".$verify_code;
        $url = 'https://smspoh.com/api/http/send?key='.$key.'&message='.$message.'&recipients='.$phone.'&sender='.'SMSPoh';
        $response = $client->get($url);
        return (bool) $response;
    }

    public function verifyCode($code){
        return $code == $this->user->verify_code;
    }

    public function saveVerified()
    {
        $user = $this->user;
        $user->is_verified = true;
        $user->save();
    }

    protected function generateVerifyCode(){
        return rand(111111,999999);
    }
}
