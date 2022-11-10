<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TableBookingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $table_id, $marker_id , $table_name, $marker_name;
    public $event_table_id;

    public function __construct($event_table_id)
    {
        $this->event_table_id = $event_table_id;
    }

    public function broadcastOn()
    {
        return ['booking-channel'];
    }

    public function broadcastAs()
    {
        return 'booked-event';
    }
}
