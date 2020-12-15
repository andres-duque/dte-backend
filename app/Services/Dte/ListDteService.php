<?php

namespace App\Services\Dte;

use App\Exceptions\GeneralException;
use App\Models\Dte;
use Illuminate\Support\Facades\DB;

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

    public static function listDteByFrequency($userId,$frequency){
        $dteQuery = Dte::where('user_id',$userId);

        if($frequency=="daily"){
            $dteQuery->whereRaw('DATE(created_at) =  DATE(NOW())');
        }

        return $dteQuery->orderBy('created_at', 'ASC')->get();
    }
}
