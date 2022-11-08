<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PointItemStoreRequest;
use App\Http\Requests\Admin\PointItemUpdateRequest;
use App\Models\PointItem;
use Illuminate\Http\Request;

class PointItemController extends BasicController
{
    public function __construct(){
        $point_item = PointItem::class;
        parent::__construct($point_item);
    }

    public function index(){
        parent::indexData();
    }

    public function store(PointItemStoreRequest $request){
        parent::storeData($request);
    }

    public function update(PointItemUpdateRequest $request, PointItem $point_item){
         parent::updateData($request,$point_item);
    }

    public function destroy(PointItem $point_item){
         parent::destroyData($point_item);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
}
