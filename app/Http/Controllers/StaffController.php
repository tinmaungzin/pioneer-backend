<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StaffPasswordUpdateRequest;
use App\Http\Requests\Admin\StaffStoreRequest;
use App\Http\Requests\Admin\StaffUpdateRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends BasicController
{

    public function __construct(){
        $staff = Staff::class;
        parent::__construct($staff);
    }


    public function index(){
        $type = request()->staff_type_id;
        parent::indexDataByType($type, 'staff_type_id');
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

    public function changePassword(StaffPasswordUpdateRequest $request,Staff $staff){
         parent::updateData($request,$staff);
    }
}
