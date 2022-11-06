<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserInterface
{
    private $user;

    public function __construct()
    {
        $this->user = null;
    }
    private array $select_data =  ['id','name','phone_number','is_archive'];
    public function listQuery($request){
        return User::orderBy('created_at', 'desc')->select($this->select_data);
    }
    function list($request) {
        $query=$this->listQuery($request);
        if($request->search_input!=null || $request->search_input!=""){
            $query->where('phone_number','LIKE','%'.$request->search_input.'%')
              ->orWhere('name','LIKE','%'.$request->search_input.'%');
        }
        return $query->get();
    }

    public function create($data)
    {
        $user =  User::create($data);
        $user->name =  'user_'.$user->id;
        $user->save();
        return $user;
    }

    public function updatePassword($data)
    {
        if (Hash::check($data['old_password'], $this->user->getAuthPassword())) {
            $data = ['password' => $data['new_password']];
            $is_updated = $this->update($data);
            if($is_updated){
                $this->user->tokens()->delete();
                return $is_updated;
            }
        }
        return false;
    }

    public function update($data)
    {
        if (isset($data['date_of_birth'])) {
            $data['date_of_birth'] = StrToDatabaseDate($data['date_of_birth']);
        }
        $updated = $this->user->update($data);
        return (bool)$updated;
    }

    public function details()
    {
        $user =  $this->user;
        $user->is_password_updateable = (bool)$this->user->getAuthPassword();
        return $user;

    }

    public function setTokenData($user)
    {
        $data = new \stdClass();
        $data->token = $user->createToken('SlazhSanctumAuth')->plainTextToken;
        $data->user_id = $user->id;
        $data->is_verified = $user->is_verified;
        responseData('data', $data, 200);
    }

    public function findUser($data)
    {
        $user =  User::where($data)->first();
        if ($user) return $user;
        responseStatus('user is not found',404);
    }

    public function getDetails($user){
        return $user;
    }



}
