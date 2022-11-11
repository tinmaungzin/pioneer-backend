<?php

namespace App\Http\Controllers;


use App\Http\Actions\Image\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function downloadImage($name)
    {
        return  $this->getImage('public',$name);
    }

    public function getImage($path,$file){
        if($file){
            $url = $path."/".$file;
        }else{
            $url = $path;
        }
        $path = storage_path("app/") . $url;

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \response($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

}
