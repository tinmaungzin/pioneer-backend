<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable=['name', 'allowed_people'];

    public function package()
    {
        return $this->hasMany(Package::class);
    }
}
