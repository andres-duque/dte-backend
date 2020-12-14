<?php

namespace App\Services\Dte;

use App\Exceptions\GeneralException;
use App\Models\Dte;
use App\Helper\Validation;

class ListDteService{

    public static function listDte($body){

        $userId = $body["userId"];
        return Dte::where('user_id',$userId)->paginate(5);

    }

    public static function listDteByToken($token){

        $dte = Dte::where('token',$token)->first();

        if(!isset($dte)){
            throw  new GeneralException("Token no existe");
        }

        return $dte;

    }
}
