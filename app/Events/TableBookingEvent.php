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
    public $test;

    public function __construct($test)
    {
        $this->test = $test;
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
