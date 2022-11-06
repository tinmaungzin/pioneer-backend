<?php

use Illuminate\Database\Eloquent\Relations\Relation;

if (!function_exists('Model')) {
    function Model($model)
    {
        return Relation::getMorphedModel($model);
    }
}

if (!function_exists('UserData')) {
    function UserData(){
        return auth('sanctum')->user();
    }
}

if (!function_exists('CurrentTime')) {
    function CurrentTime()
    {
        return now()->format('Y-m-d H:i:s');
    }
}

if (!function_exists('JsonDecode')) {
    function JsonDecode($raw_data)
    {
        $input_items = stripslashes(str_replace(array('\"', '&quot;', '\n'), '', $raw_data));
        $json_data = json_decode($input_items);
        if ($json_data == null) {
            responseStatus('input data is not correct', 402);
        }
        return $json_data;
    }
}

if (!function_exists('FirstWord')) {
    function FirstWord($code)
    {
        return intval(substr($code, 0, 1));
    }
}

if (!function_exists('UnsetData')) {
    function UnsetData($data, $attributes)
    {
        foreach ($attributes as $attribute) {
            unset($data[$attribute]);
        }
        return $data;
    }
}

if (!function_exists('RandomDigits')) {
    function RandomDigits()
    {
        return rand(1111, 9999);
    }
}

if (!function_exists('IntendedURL')) {
    function IntendedURL($request)
    {
        $request->session()->regenerate();
        return redirect()->intended('/default')->getTargetUrl();
    }
}

if (!function_exists('StrToDatabaseDate')) {
    function StrToDatabaseDate($str)
    {
        return date('Y-m-d', strtotime($str));
    }
}



