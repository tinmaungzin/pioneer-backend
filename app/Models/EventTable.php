<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTable extends Model
{
    protected $fillable = ['booking_status', 'event_id', 'table_id'];
    protected $appends = ['price'];
    protected $with = ['table','event'];
    protected  $table;

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function getPriceAttribute()
    {
        $type_id = $this->table()->pluck('type_id')->first();
        $event = $this->event;
        return SetType::where('set_id', $event->set_id)
            ->where('type_id', $type_id)
            ->pluck('price')
            ->first();
    }
}

