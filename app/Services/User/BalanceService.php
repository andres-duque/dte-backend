<?php

namespace App\Services\User;

use App\Models\User;

class BalanceService{

    public static function getBalance($body){

        $userId = $body["userId"];
        $userInfo =  User::where('id',$userId)->first();
        return [
            "balance"=>$userInfo->balance
        ];
    }

}
