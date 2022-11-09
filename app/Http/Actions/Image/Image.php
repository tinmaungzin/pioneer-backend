<?php

namespace App\Http\Actions\Image;

class Image
{
    public static function upload($image)
    {
        $image_name = uniqid() . '_' . $image->getClientOriginalName();
        $image_name = str_replace(' ', '', $image_name);
        $image->move(storage_path() . '/images/', $image_name);
        return $image_name;
    }

    public function delete($image)
    {
        $file = public_path('/images/' . $image);
        if (file_exists($file)) unlink($file);
    }

    public function download($name){
        return response()->file(public_path().'/images/'.$name);
    }

}
