<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\SetTypeStoreRequest;
use App\Http\Requests\Admin\SetTypeUpdateRequest;
use App\Models\SetType;
use App\Models\Table;
use App\Models\Type;
use Illuminate\Http\Request;

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
        $request_set_price = $request->set_price;
        $request_table_count = $request->table_count;
        $request_type_id = $request->type_id;
        if($request_set_price && $request_table_count && $request_type_id ){
            $type = Type::find($request_type_id);
            $set_prices = JsonDecode($request->set_price);
            foreach ($set_prices as $set_price){
                 SetType::firstOrCreate([
                    'set_id' => $set_price->set_id,
                    'type_id'=>$request_type_id],[
                    'price' => $set_price->price,
                    'table_count' => $request_table_count,
                ]);
            }
            for($i = 1; $i <= $request_table_count ; $i++ ){
                Table::create([
                    'name' => $type->name . $i,
                    'type_id' => $request_type_id
                ]);
            }
        }
        if($request_table_count && $request_type_id && (!$request_set_price)){
            $type = Type::find($request_type_id);
            $old_count = 0;
            $set_types = SetType::where('type_id',$request_type_id)->get();
            foreach ($set_types  as $set_type){
                $old_count = $set_type->table_count;
                $set_type->update([
                    'table_count' => $request_table_count + $old_count,
                ]);
            }
            for($x= 1; $x <= $request_table_count ; $x++ ){
                Table::create([
                    'name' => $type->name . ++$old_count,
                    'type_id' => $request_type_id
                ]);
            }
        }
        if($request_set_price && $request_type_id && (!$request_table_count)){
            $set_prices = JsonDecode($request->set_price);
            foreach ($set_prices as $set_price){
                SetType::updateOrCreate([
                    'set_id' => $set_price->set_id,
                    'type_id'=>$request_type_id],[
                    'price' => $set_price->price,
                ]);
            }
        }
    }
}
