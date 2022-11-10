<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable=['name', 'date', 'set_id', 'walk_in_price', 'is_available', 'photo'];
    protected $with = ['tables'];

    public function tables(){
        return $this->belongsToMany(Table::class,'event_tables');
    }
}
