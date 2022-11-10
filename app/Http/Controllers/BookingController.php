<?php

namespace App\Http\Controllers;

use App\Events\TableBookingEvent;
use App\Http\Requests\Admin\BookingStoreRequest;
use App\Http\Requests\Admin\BookingUpdateRequest;
use App\Models\Booking;
use App\Models\EventTable;
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
        responseTrue('successfully updated');

        //  parent::updateData($request,$booking);
    }

    public function destroy(Booking $booking){
         parent::destroyData($booking);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
}
