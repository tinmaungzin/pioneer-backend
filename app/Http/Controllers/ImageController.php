<?php

namespace App\Http\Controllers;


use App\Http\Actions\Image\Image;



class ImageController extends Controller
{
    public function downloadImage($name)
    {
        return  Image::download($name);
    }

}
