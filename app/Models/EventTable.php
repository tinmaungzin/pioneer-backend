<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTable extends Model
{
    use HasFactory;
    protected $fillable=['booking_status', 'event_id', 'table_id'];
    protected $with = ['event', 'table'];

    public function event(){
        return $this->belongsTo(Event::class);
    }
    
    public function table(){
        return $this->belongsTo(Table::class);
    }
}
