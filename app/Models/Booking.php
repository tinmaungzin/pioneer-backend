<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=['name', 'phone_number', 'user_id', 'event_table_id'];

    public function event_table(){
        return $this->belongsTo(EventTable::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
