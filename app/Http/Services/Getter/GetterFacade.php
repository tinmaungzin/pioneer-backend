<?php

namespace App\Http\Services\Getter;

use Illuminate\Support\Facades\Facade;

/**
 * @method static singerProfiles(\Illuminate\Support\Collection $singers)
 * @method static specifications(mixed $specifications)
 * @method static name($name_translations)
 * @method static song(\App\Models\Song $song)
 * @method static singerProfile(mixed $int)
 * @method static album(mixed $album)
 * @method static albumList($albums)
 */
class GetterFacade extends Facade
{

    protected static function getFacadeAccessor() {

        return 'getter';
    }
}
