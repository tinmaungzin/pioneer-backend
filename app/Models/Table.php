<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable=['name', 'type_id','is_available'];
    protected $with = ['type'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
