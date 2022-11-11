<?php

namespace App\Http\Actions\Image;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Image
{
    public static function upload($image)
    {
        $path = Storage::putFile('public', $image);
        return str_replace('public/', '', $path);
    }

    public static function delete($image)
    {
        $path = self::setUrl($image);
        if (File::exists($path)) Storage::delete($path);
    }

    public static function download($file)
    {
        $path =  self::setUrl($file);
        if (!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = \response($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public  static  function setUrl($file){
        $path = 'public';
        if ($file) {
            $url = $path . "/" . $file;
        } else {
            $url = $path;
        }
        return storage_path("app/") . $url;
    }


}
