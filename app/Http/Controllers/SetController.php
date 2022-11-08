<?php

namespace App\Http\Controllers;

use App\Events\TableBookingEvent;
use App\Http\Requests\Admin\SetStoreRequest;
use App\Http\Requests\Admin\SetUpdateRequest;
use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SetController extends BasicController
{
    public function __construct(){
        $set = Set::class;
        parent::__construct($set);
    }

    public function index(){
        parent::indexData();
    }

    public function store(SetStoreRequest $request){
        Log::info("test");
        event(new TableBookingEvent('test'));
        parent::storeData($request);
    }

    public function update(SetUpdateRequest $request, Set $set){
         parent::updateData($request,$set);
    }

    public function destroy(Set $set){
         parent::destroyData($set);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
}
