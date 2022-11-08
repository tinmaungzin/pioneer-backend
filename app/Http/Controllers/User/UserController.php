<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaffPasswordUpdateRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BasicController
{
    public function __construct(){
        $user = User::class;
        parent::__construct($user);
    }

    public function index(){
        $type = request()->user_type_id;
        parent::indexDataByType($type, 'user_type_id');
    }

    public function store(UserStoreRequest $request){
        parent::storeData($request);
    }

    public function update(UserUpdateRequest $request, User $user){
         parent::updateData($request,$user);
    }

    public function destroy(User $user){
         parent::destroyData($user);
    }

    public function search(Request $request){
         parent::searchData($request);
    }

    public function changePassword(StaffPasswordUpdateRequest $request,User $user){
        parent::updateData($request,$user);
   }

    public function getAuthUser(Request $request){
        return UserData();
    }
}
