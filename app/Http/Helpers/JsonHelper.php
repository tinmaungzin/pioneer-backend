<?php

if(!function_exists('responseData')){
    function responseData($name,$data,$status){
        return response()->json([
            $name => $data
        ],$status)->send() && exit(1);
    }
}

if(!function_exists('responseStatus')){
    function responseStatus($message,$status){
        return responseData('message',$message,$status);
    }
}

if(!function_exists('responseFalse')){
    function responseFalse(){
        return responseData('message','Something is wrong at Server',500);
    }
}


if(!function_exists('responseTrue')){
    function responseTrue($message){
        return responseData('message',$message,200);
    }
}

if(!function_exists('responseRedirect')){
    function responseRedirect($request,$data ,$message){
        $intended_url = IntendedURL($request);
        $response = [
            'redirectUrl' => $intended_url,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response);
    }
}
