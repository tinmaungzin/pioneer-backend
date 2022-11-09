<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TypeStoreRequest;
use App\Http\Requests\Admin\TypeUpdateRequest;
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

    public function store(TypeStoreRequest $request){
        parent::storeData($request);
    }

    public function update(TypeUpdateRequest $request, Type $type){
         parent::updateData($request,$type);
    }

    public function destroy(Type $type){
         parent::destroyData($type);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
}
