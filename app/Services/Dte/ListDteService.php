<?php

namespace App\Services\Dte;

use App\Models\Dte;
use App\Helper\Validation;

class ListDteService{

    public static function listDte($body){

        $userId = $body["userId"];
        return Dte::where('user_id',$userId)->paginate(5);

    }

}
