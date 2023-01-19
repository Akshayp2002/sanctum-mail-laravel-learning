<?php

namespace App\Http\Helpers;
use Illuminate\Http\Exceptions\HttpResponseException;

class Helper{
    public static function sendError($message, $errore = [],$code = 401){

        $response =['success'=>false, 'message'=>$message];
        if(!empty($error)){
            $response['data']=$error;
        }

        throw new HttpResponseException(response()->json($response, $code));


    }
}