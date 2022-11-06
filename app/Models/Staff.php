<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Staff  extends Authenticatable
{
    use HasApiTokens;
    protected $fillable=['name', 'email','staff_type_id'];
    protected $hidden = ['password'];
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
