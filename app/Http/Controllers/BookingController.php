<?php

namespace App\Http\Controllers;

use App\Events\TableBookingEvent;
use App\Filters\BookingFilters;
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
    public function __construct()
    {
        $booking = Booking::class;
        parent::__construct($booking);
    }

    public function index()
    {
        parent::indexData();
    }

    public function store(BookingStoreRequest $request)
    {
        $event_table = EventTable::find($request->event_table_id);
        $event_table->booking_status = $request->booking_status;
        $event_table->save();
        event(new TableBookingEvent($request->event_table_id));
        parent::storeData($request);
    }

    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $event_table = EventTable::find($request->event_table_id);
        $event_table->booking_status = $request->booking_status;
        $event_table->save();
        $event = Event::find($event_table->event_id);
        $table = Table::find($event_table->table_id);
        $price = SetType::where('set_id', $event->set_id)->where('type_id', $table->type_id)->pluck('price')->first();
        $user = $booking->user;
        if ($request->booking_status == "available" && $request->has('customers_left') && $request->customers_left == 0) {

            $points = round($price / 1000);
            if ($user && $user->user_type->id == 1) {
                $user->point = $user->point - $points;
                if ($booking->use_balance == 1) $user->balance = $user->balance + $price;
                $user->save();
            }
        }
        if ($request->booking_status == "confirmed") {
            $points = round($price / 1000);
            if ($user && $user->user_type->id == 1) {
                $user->point = $user->point + $points;
                if ($booking->use_balance == 1) {
                    if ($user->balance >= $price) $user->balance = $user->balance - $price;
                    else responseFalse("Not enough balance!");
                }
                $user->save();
            }
        }
        event(new TableBookingEvent($request->event_table_id));
        responseTrue('successfully updated');
    }

    public function destroy(Booking $booking)
    {
        parent::destroyData($booking);
    }

    public function search(Request $request)
    {
        parent::searchData($request);
    }
    public function getBookingByEventTableId()
    {
        $event_table_id = request("event_table_id");
        $booking = Booking::where("event_table_id", $event_table_id)->orderBy("created_at", "desc")->first();
        ($booking) ?
            responseData('booking', $booking, 200) :
            responseStatus('No booking is found', 404);
    }

    public function getBookingByUserId()
    {
        $user_id = request("user_id");
        if (request("type") == "all") $bookings = Booking::where("user_id", $user_id)->orderBy("created_at", "desc")->get();
        else $bookings = Booking::where("user_id", $user_id)->whereRelation('event_table', 'booking_status', '=', 'confirmed')->orderBy("created_at", "desc")->get();
        $total = 0;
        foreach ($bookings  as $booking) {
            $booking->price = SetType::where('set_id', $booking->event_table->event->set_id)->where('type_id', $booking->event_table->table->type_id)->pluck('price')->first();
            $total = $total + $booking->price;
        }
        ($bookings) ?
            responseArrayData(array("bookings" => $bookings, "total" => $total), 200) :
            responseStatus('No booking is found', 404);
    }

    public function getBookingsForReport(Request $request, BookingFilters $filters)
    {
        $bookings = Booking::filter($filters)->whereRelation('event_table', 'booking_status', '=', 'confirmed')->orderBy("created_at", "desc")->get();
        $total = 0;
        foreach ($bookings  as $booking) {
            $booking->price = SetType::where('set_id', $booking->event_table->event->set_id)->where('type_id', $booking->event_table->table->type_id)->pluck('price')->first();
            $total = $total + $booking->price;
        }
        ($bookings) ?
            responseArrayData(array("bookings" => $bookings, "total" => $total), 200) :
            responseStatus('No booking is found', 404);
    }
}
