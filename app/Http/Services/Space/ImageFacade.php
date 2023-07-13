<?php

namespace App\Http\Services\Space;

use App\Http\Actions\Image\Image;
use Illuminate\Support\Facades\Facade;

/**
 * @method static upload($value)
 * @method static link($value)
 * @method static delete($photo)
 *
 */
class ImageFacade extends Facade
{

    protected static function getFacadeAccessor(){
        return  new Image();
    }
}

