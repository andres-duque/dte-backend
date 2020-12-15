<?php

namespace App\Services\Dte;

use App\Exceptions\GeneralException;
use App\Models\Dte;
use App\Helper\Validation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PayDteService{

    public static function pay($body){

        $token = $body["token"];
        $buyerName = $body["buyerName"];
        $buyerDocument = $body["buyerDocument"];
        $buyerPhone = Validation::validateIsSet($body,'buyerPhone');
        $ip = $body["ip"];

        $dte = Dte::where('token',$token)->first();

        if(!isset($dte)){
            throw  new GeneralException("Factura no existe");
        }

        if($dte->status == "approved"){
            throw  new GeneralException("Factura ya ha sido pagada");
        }

        $dte->status = 'approved';
        $dte->buyer_name = $buyerName;
        $dte->buyer_phone = $buyerPhone;
        $dte->buyer_document = $buyerDocument;
        $dte->payment_ip = $ip;

        try {
            DB::beginTransaction();
            $dte->save();
            User::find($dte->user_id)->increment('balance', $dte->total_amount);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            throw new GeneralException("Ocurrio un error procesando su pago");
        }

        return $dte;
    }

}
