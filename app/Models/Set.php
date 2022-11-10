<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable=['name'];

    protected $with = ['type_prices'];

    public function type_prices(){
        return $this->belongsToMany(Type::class,'set_type')
            ->withPivot('price');
    }



}
