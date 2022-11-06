<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Auth\AuthInterface;
use Illuminate\Http\Request;

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
        return $this->auth->login($request,'admin');
    }

    public function getReceptionistLogin (Request $request){
        return $this->auth->login($request,'receptionist');
    }

    public function getSalespersonLogin (Request $request){
        return $this->auth->login($request,'salesperson');
    }
}
