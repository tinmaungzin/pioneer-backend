<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use Filterable;
    use HasFactory;
    protected $fillable=['name', 'phone_number', 'user_id', 'event_table_id', 'photo','use_balance', 'note','admin_note'];
    protected $with = ['user', 'event_table'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function event_table(){
        return $this->belongsTo(EventTable::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
