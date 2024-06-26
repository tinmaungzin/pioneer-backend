<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Auth\AuthInterface;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private  $auth;
    public function __construct(AuthInterface $auth){
        $this->auth = $auth;
    }

    public function getUserLogin (Request $request){
        return $this->auth->login($request,'user');
    }

    public function getAdminLogin (Request $request){
        Log::info('here');
        return $this->auth->login($request,'admin');
    }

    public function getReceptionistLogin (Request $request){
        return $this->auth->login($request,'receptionist');
    }

    public function getSalespersonLogin (Request $request){
        return $this->auth->login($request,'salesperson');
    }

    public function getMobileLogin(Request $request)
    {
        $phone_number = $request->phone_number;
        $user = User::where('phone_number',$phone_number)->first();
        if($user){
            $type_id = $user->user_type_id;
            if($type_id ==  1){
                return $this->auth->login($request,'user');
            }
            return $this->auth->login($request,'salesperson');
        }
        responseStatus('This phone number is not exists',422);
    }

    public function getAuthLogin(Request $request)
    {
        $email = $request->email;
        $staff = Staff::where('email',$email)->first();
        if($staff){
            $type_id = $staff->staff_type_id;
            if($type_id ==  1){
                return $this->auth->login($request,'admin');
            }
            return $this->auth->login($request,'receptionist');
        }
        responseStatus('This email is not exists',422);
    }
}
