<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\SetTypeStoreRequest;
use App\Http\Requests\Admin\SetTypeUpdateRequest;
use App\Models\SetType;
use App\Models\Table;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SetTypeController extends BasicController
{
    public function __construct(){
        $set_type = SetType::class;
        parent::__construct($set_type);
    }


    public function index(){
        parent::indexData();
    }

    public function store(SetTypeStoreRequest $request){
        $this->saveData($request);
        responseTrue('successfully created');
    }

    public function update(SetTypeUpdateRequest $request, SetType $set_type){
         parent::updateData($request,$set_type);
    }

    public function destroy(SetType $set_type){
         parent::destroyData($set_type);
    }

    public function search(Request $request){
         parent::searchData($request);
    }

    public function saveData($request)
    {
        $data = $request->all();
        $set_type = SetType::create($data);
        $type = Type::find($data['type_id']);
        $existing_tables = Table::where('type_id', $set_type->type_id)->get()->count();
        for ($x = $existing_tables; $x < ($data['table_count'] + $existing_tables) ; $x++) {
            $table_data['name'] = $type->name . $x+1;
            $table_data['type_id'] = $data['type_id'];
            $table_data['is_available'] = 1;
            Log::info($table_data);
            Table::create($table_data);
        }
    }
}
