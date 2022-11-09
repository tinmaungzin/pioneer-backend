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
        $set_tables = [];
        $set_types =  SetType::all();
        $group_set_types =  collect($set_types)->groupBy('type_id')->values();
        foreach ($group_set_types as $group_set_type){
            $set_table = new \stdClass();
            $set_table->type_id = $group_set_type[0]->type_id;
            $set_table->type_name = $group_set_type[0]->type->name;
            $set_table->table_count =  $group_set_type[0]->table_count;
            $set_prices = [];
            foreach ($group_set_type as $set_type) {
                $set_price = new \stdClass();
                $set_price->set_id = $set_type->set_id;
                $set_price->set_name = $set_type->set->name;
                $set_price->price = $set_type->price;
                $set_prices [] = $set_price;
            }
            $set_table->set_prices = $set_prices;
            $set_tables [] = $set_table;
        }
        responseData('set_tables',$set_tables,200);
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
