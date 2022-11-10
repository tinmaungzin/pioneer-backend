<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=['name', 'date', 'set_id', 'walk_in_price', 'is_available', 'photo'];
    protected $with = ['tables'];

    public function tables(){
        return $this->belongsToMany(Table::class,'event_tables')
            ->withPivot('booking_status', 'id');
    }

    public function set(){
        return $this->belongsTo(Set::class);
    }




}
