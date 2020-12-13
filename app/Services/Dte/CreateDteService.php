<?php

namespace App\Services\Dte;

use App\Models\Dte;
use App\Helper\Validation;

class CreateDteService{

    public static function create($body){

        $email = $body["email"];
        $buyerName = $body["buyerName"];
        $itemName = $body["itemName"];
        $itemQuantity = $body["itemQuantity"];
        $itemAmount = $body["itemAmount"];
        $itemType = $body["itemType"];
        $ip = $body["ip"];
        $userId = $body["userId"];

        // fill optionals params
        $buyerPhone = Validation::validateIsSet($body,'buyerPhone');
        $itemDescription = Validation::validateIsSet($body,'itemDescription');
        $discountRate = Validation::validateIsSet($body,'discountRate',0);
        $iva = Validation::validateIsSet($body,'iva',false);
        $totalAmount = ($itemAmount * $itemQuantity);

        if($discountRate>0){
            $totalAmount = $totalAmount - ($totalAmount * ($discountRate*0.01));
        }

        if($iva){
            $totalAmount = $totalAmount * (1+( env("IVA_PERCENT")*0.01));
        }

        $dte = new Dte;
        $dte->status = 'pending';
        $dte->email =  $email;
        $dte->buyer_name = $buyerName;
        $dte->buyer_phone = $buyerPhone;
        $dte->discount_rate = $discountRate;
        $dte->item_name = $itemName;
        $dte->item_description = $itemDescription;
        $dte->item_type = $itemType;
        $dte->item_qty = $itemQuantity;
        $dte->item_amount = $itemAmount;
        $dte->iva = $iva;
        $dte->payment_ip = $ip;
        $dte->token = \Illuminate\Support\Str::random(32);
        $dte->total_amount = $totalAmount;
        $dte->user_id = $userId;
        $dte->save();

        return $dte;
    }

}
