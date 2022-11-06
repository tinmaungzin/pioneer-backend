<?php
if (!function_exists('PaginateData')) {
    function PaginateData($model)
    {
        //return $model::orderBy('id', 'desc')->paginate(20);
        return $model::paginate(20);
    }
}

if (!function_exists('CreateData')) {
    function CreateData($request, $model, $route)
    {
        StoreData($request, $model);
        return redirect(route($route));
    }
}

if (!function_exists('StoreData')) {
    function StoreData($request, $model)
    {
        $data = $request->validated();
        return $model::create($data);
    }
}

if (!function_exists('DeleteData')) {
    function DeleteData($data, $route)
    {
        $data->delete();
        return redirect(route($route));
    }
}

if (!function_exists('UpdateData')) {
    function UpdateData($request, $data, $route)
    {
        $input = $request->all();
        $data->update($input);
        return redirect(route($route));
    }
}
