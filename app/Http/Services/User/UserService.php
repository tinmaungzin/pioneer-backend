<?php

namespace App\Http\Services\User;

use App\Http\Repositories\User\UserInterface;

class UserService
{
    protected $user;
    public function __construct(UserInterface $user){
        $this->user = $user;
    }

    public function create($data){
        return $this->user->create($data);
    }

    public function setUserToken($user){
        return $this->user->setTokenData($user);
    }

    public function findUser($data){
        return $this->user->findUser($data);
    }
}
