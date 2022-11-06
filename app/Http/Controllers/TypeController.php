<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends BasicController
{
    public function __construct(){
        $type = Type::class;
        parent::__construct($type);
    }


    public function index(){
        parent::indexData();
    }

    public function store(StaffStoreRequest $request){
        parent::storeData($request);
    }

    public function update(StaffUpdateRequest $request, Staff $staff){
         parent::updateData($request,$staff);
    }

    public function destroy(Staff $staff){
         parent::destroyData($staff);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
}
