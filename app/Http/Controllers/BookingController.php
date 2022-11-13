<?php

namespace App\Http\Controllers;

use App\Events\TableBookingEvent;
use App\Http\Requests\Admin\BookingStoreRequest;
use App\Http\Requests\Admin\BookingUpdateRequest;
use App\Models\Booking;
use App\Models\Event;
use App\Models\EventTable;
use App\Models\SetType;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends BasicController
{
    public function __construct(){
        $booking = Booking::class;
        parent::__construct($booking);
    }

    public function index(){
        parent::indexData();
    }

    public function store(BookingStoreRequest $request){
        $event_table = EventTable::find($request->event_table_id);
        $event_table->booking_status = $request->booking_status;
        $event_table->save();
        event(new TableBookingEvent($request->event_table_id));
        parent::storeData($request);
    }

    public function update(BookingUpdateRequest $request, Booking $booking){
        $event_table = EventTable::find($request->event_table_id);
        $event_table->booking_status = $request->booking_status;
        $event_table->save();
        $event = Event::find($event_table->event_id);
        $table = Table::find($event_table->table_id);
        $price = SetType::where('set_id',$event->set_id)->where('type_id',$table->type_id)->pluck('price')->first();
        $user = $booking->user;
        Log::info($booking);
        if($request->booking_status == "available" && $request->customers_left == 0 )
        {
            $points = round($price / 1000) ;
            if($user)
            {
                $user->point = $user->point - $points;
                if($booking->use_balance == 1) $user->balance = $user->balance + $price;
                $user->save();
            }
        }
        if($request->booking_status == "confirmed")
        {
            $points = round($price / 1000) ;
            if($user)
            {
                $user->point = $user->point + $points;
                if($booking->use_balance == 1) $user->balance = $user->balance - $price;
                $user->save();
            }
        }
        event(new TableBookingEvent($request->event_table_id));
        responseTrue('successfully updated');
    }

    public function destroy(Booking $booking){
         parent::destroyData($booking);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
    public function getBookingByEventTableId()
    {
        $event_table_id = request("event_table_id");
        $booking = Booking::where("event_table_id", $event_table_id)->orderBy("created_at", "desc")->first();
        ($booking) ?
        responseData('booking', $booking, 200) :
        responseStatus('No booking is found',404);
    }
}
