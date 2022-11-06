<?php

namespace App\Http\Repositories\Auth;

interface AuthInterface
{
    public function login($request,$role);

    public function setTokenData($auth_user,$role);
}
