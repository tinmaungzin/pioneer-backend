<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Auth\AuthInterface;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    private  $auth;
    public function __construct(AuthInterface $auth){
        $this->auth = $auth;
    }

    public function login (Request $request){
        return $this->auth->login($request,'user');
    }
}
