<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable=['name', 'details','type_id'];
    protected $with = ['type'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
