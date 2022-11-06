<?php


namespace App\Http\Repositories\User;


interface UserInterface
{
    public function create($data);

    public function details();
    public function setTokenData($user);

    public function update($data);
    public function updatePassword($data);

    public function findUser($data);
    public function list($request);

    public function getDetails($user);

}
