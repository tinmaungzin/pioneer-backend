<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable=['name', 'type_id','is_available'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
