<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use App\Models\Event;
use App\Models\Package;
use App\Models\SetType;
use App\Models\Table;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Actions\Image\Image;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class EventController extends BasicController
{
    public function __construct(){
        $this->event = Event::class;
        parent::__construct($this->event);
    }

    public function getAllTables()
    {
        $tables = Table::all();
        ($tables) ?
        responseData('tables', $tables, 200) :
        responseStatus('No table is found',404);
    }

    public function getAllEvents()
    {
        $events = Event::all();
        ($events) ?
        responseData('events', $events, 200) :
        responseStatus('No events is found',404);
    }

    public function availableEvents()
    {
        $events = Event::with('set')->where('is_available', 1)->get();
        foreach($events  as $event){
            foreach ($event->tables  as $table){
                $table->price =  SetType::where('set_id',$event->set_id)->where('type_id',$table->type_id)->pluck('price')->first();
                $table->event_table_id = $table->pivot->id;
                $table->booking_status = $table->pivot->booking_status;
                $table->allowed_people = Type::where('id',$table->type_id)->pluck('allowed_people')->first();
                $table->packages = Package::where('type_id',$table->type_id)->get();
                UnsetData($table,['pivot','created_at','updated_at']);
            }
            UnsetData($event,['set','created_at','updated_at']);
        }
        ($events) ?
        responseData('events', $events, 200) :
        responseStatus('No event is found',404);
    }


    public function index(){
        parent::indexData();
    }

    public function store(EventStoreRequest $request){
            $this->saveData($request);
            responseTrue('successfully created');
    }

    public function update(EventUpdateRequest $request, Event $event){
        $this->saveData($request, $event);
        responseTrue('successfully updated');
    }

    public function destroy(Event $event){
         parent::destroyData($event);
    }

    public function search(Request $request){
         parent::searchData($request);
    }

    public function saveData($request, $event = null)
    {
        $data = $request->all();
        if($request->has('photo')){
            $path = (new Image())->upload($request->photo);
            $data['photo'] = $path;
        }
        if($request->has('layout_photo')){
            $path = (new Image())->upload($request->layout_photo);
            $data['layout_photo'] = $path;
        }
        $data['date'] = Carbon::parse($data['date']);
        try
        {
            if($event) $event->update($data);
            else $event = $this->event::create($data);
            if($request->tables && $event)
            {
                $tables = JsonDecode($request->tables);
                $event->tables()->detach();
                $event->tables()->attach($tables);
            }
        }catch(Exception $e){
            responseFalse("Invalid or incomplete input!");
        }

    }


}
