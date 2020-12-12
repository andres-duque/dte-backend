<?php


namespace App\Helper;

class GeneralResponse
{

    public static function buildResponse($success,$message,$data)
    {
        return response()->json([
            "success"=>$success,
            "message"=>$message,
            "data"=>$data
        ]);
    }

}
