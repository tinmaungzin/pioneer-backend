<?php

namespace App\Http\Services\User;

use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'App\Http\Services\User\UserService';
    }
}
