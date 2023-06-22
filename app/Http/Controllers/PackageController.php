<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PackageStoreRequest;
use App\Http\Requests\Admin\PackageUpdateRequest;
use App\Models\Package;
use App\Models\Set;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PackageController extends BasicController
{
    public function __construct(){
        $package = Package::class;
        parent::__construct($package);
    }


    public function getAllTypes()
    {
        $types = Type::all();
        ($types) ?
        responseData('types', $types, 200) :
        responseStatus('No type is found',404);
    }

    public function getAllSets()
    {
        $sets = Set::all();
        ($sets) ?
        responseData('sets', $sets, 200) :
        responseStatus('No set is found',404);
    }


    public function index(){
        parent::indexData();
    }

    public function store(PackageStoreRequest $request){
        Log::info($request);
        parent::storeData($request);
    }

    public function update(PackageUpdateRequest $request, Package $package){
        Log::info($request);
         parent::updateData($request,$package);
    }

    public function destroy(Package $package){
         parent::destroyData($package);
    }

    public function search(Request $request){
         parent::searchData($request);
    }
}
