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
        $type = $this->setType($role);
        $auth_user = $this->findAuthUser($data,$type,$role);
        if ($auth_user) {
            if($auth_user->is_verified == 0) {
                responseStatus('This phone number is not verified yet!',401);
            }
            if (Hash::check($data->password, $auth_user->password)) {
                return $auth_user;
            } else {
                responseStatus('Password is not corrected',422);
            }
        }
        responseStatus('This phone number is not exists',422);
    }

    public function findAuthUser($data,$type,$role){
        $credentials = $this->getModelData($data);
        $auth_user = Model($type)::where($credentials[$role])->first();
        return ($auth_user) ?: null;
    }

    protected function setType($role){
        $type = null ;
        if(in_array($role,['admin','receptionist'])){
            $type = 'staff';
        }
        if(in_array($role,['user','salesperson'])){
            $type = 'user';
        }
        return $type;
    }

    public function createToken($auth_user,$role){
        return  $auth_user->createToken('Pioneer Access Token',['role:'.$role]);
    }

    public function getModelData($data){
       return array(
            "admin" => [['email', $data->email],['staff_type_id',1]],
            "receptionist" => [['email', $data->email],['staff_type_id',2]],
            "user" => [['phone_number',$data->phone_number],['user_type_id',1]],
            "salesperson" => [['phone_number',$data->phone_number],['user_type_id',2]],
        );
    }
}
