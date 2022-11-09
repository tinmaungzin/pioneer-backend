<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use App\Models\Event;
use App\Models\Set;
use App\Models\SetType;
use App\Models\Table;
use Illuminate\Http\Request;

class EventController extends BasicController
{
    public function __construct(){
        $event = Event::class;
        parent::__construct($event);
    }

    public function getAllTables()
    {
        $tables = Table::all();
        ($tables) ?
        responseData('tables', $tables, 200) :
        responseStatus('No table is found',404);
    }

    public function getTablesBySetId(Request $request,Set $set){
        $set_id = $set->id;
        $price = [];
        $type_ids = SetType::where('set_id', $set_id)->distinct('type_id')->pluck('type_id');
        $set_types = SetType::where('set_id', $set_id)->distinct('type_id')->select('type_id','set_id','price')->get();
        foreach ($set_types as $set_type) {
            $price[$set_type->type_id] = $set_type->price;
        }
        $tables =  Table::with('type')
            ->whereIn('type_id',$type_ids)
            ->where('is_available',true)
            ->select('id','name','type_id')
            ->get();
        foreach ($tables as $table){
            $table->price = $price[$table->type_id];
            $table->allowed_people = $table->type->allowed_people;
            UnsetData($table,['type']);
        }
        return $tables;
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
