<?php

namespace App\Http\Controllers;


use App\Http\Actions\Image\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
    public function downloadImage($name)
    {
        $path = storage_path('images/' . $name);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        return $file;
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }
}
