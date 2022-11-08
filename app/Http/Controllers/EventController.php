<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use App\Models\Event;
use App\Models\SetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends BasicController
{
    public function __construct(){
        $event = Event::class;
        parent::__construct($event);
    }


    public function getTablesBySetId(Request $request)
    {
        $set_id = $request->set_id;
        $setTypes = SetType::where('set_id', $set_id)->get();
        Log::info($setTypes);
    }

    public function index(){
        parent::indexData();
    }

    public function store(EventStoreRequest $request){
        parent::storeData($request);
    }

    public function update(EventUpdateRequest $request, Event $event){
         parent::updateData($request,$event);
    }

    public function destroy(Event $event){
         parent::destroyData($event);
    }

    public function search(Request $request){
         parent::searchData($request);
    }


}
