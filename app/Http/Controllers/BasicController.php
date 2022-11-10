<?php

namespace App\Http\Controllers;

use App\Http\Actions\Image\Image;

class BasicController extends Controller
{
    private $model;
    public function __construct($model){
        $this->model = $model;
    }

    public function indexData($type = null){
        if($type) $data = $this->model::where('type', $type)->orderBy('id', 'desc')->paginate(20)->withQueryString();
        else $data = $this->model::orderBy('id', 'desc')->paginate(20)->withQueryString();
        responseData('data',$data,200);
    }

    public function indexDataByType($type = null, $var=null)
    {
        $data = $this->model::where($var, $type)->orderBy('id', 'desc')->paginate(20)->withQueryString();
        responseData('data',$data,200);
    }

    public function storeData($request){
        $data = $request->all();
        if($request->has('photo')){
            $path = (new Image())->upload($request->photo);
            $data['photo'] = $path;
        }
        responseTrue('successfully created');
    }

    public function updateData($request, $data){
        $input_data = $request->all();
        if($request->has('photo')){
            $path = (new Image())->upload($request->photo);
            $input_data['photo'] = $path;
            if($data->photo)  (new Image())->delete($data->photo);
        }
        $data->update($input_data);
        responseTrue('successfully updated');
    }

    public function destroyData($data){
        if($data){
            if(isset($data->photo) && $data->photo <> null ) {
                (new Image())->delete($data->photo);
            }
            $data->delete();
            responseTrue('successfully deleted');
        }
        responseStatus('Data is not found','404');
    }

    public function searchData($request){
        $query = $request->all()['query'];
        $data = $this->model::where('name', 'LIKE', "%{$query}%")->paginate(20)->withQueryString();
        responseData('data',$data,200);
    }


}
