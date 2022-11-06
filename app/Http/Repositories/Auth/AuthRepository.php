<?php

namespace App\Http\Repositories\Auth;

use Illuminate\Support\Facades\Hash;

class AuthRepository implements  AuthInterface
{
    public function login($request,$role){
        $auth_user = $this->checkCredentials($request,$role);
        $data = $this->setTokenData($auth_user,$role);
        responseData('data',$data,200);
    }

    public function setTokenData($auth_user,$role){
        $token = $this->createToken($auth_user,$role);
        $data = new \stdClass();
        $data->token = $token->plainTextToken;
        $model = Model($token->accessToken->tokenable_type);
        $data->auth_user = $model::find($token->accessToken->tokenable_id);
        return $data;
    }

    protected function checkCredentials($data,$role){
        $auth_user = $this->findAuthUser($data,$role);
        if ($auth_user) {
            if (Hash::check($data->password, $auth_user->password)) {
                return $auth_user;
            } else {
                responseStatus('Password is not correct',422);
            }
        }
        responseStatus('The given data is not exists',422);
    }

    public function findAuthUser($data,$role){
        $credentials = $this->getModelData($data);
        $auth_user = Model($role)::where([$credentials[$role]])->first();
        return ($auth_user) ?: null;
    }

    public function createToken($auth_user,$role){
        return  $auth_user->createToken('Vox Access Token',['role:'.$role]);
    }

    public function getModelData($data){
       return array(
            "admin" => ['email', $data->email],
            "singer" => ['email', $data->email],
            "user" => ['phone_number',$data->phone_number]
        );
    }
}
