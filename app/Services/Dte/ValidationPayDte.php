<?php

namespace App\Services\Dte;

use App\Exceptions\GeneralException;
use App\Helper\Validation;

class ValidationPayDte{

    public static function validate($body){

        $errors = [];

        Validation::validateStringLength($errors,$body,'buyerPhone',["gte"=>8,"lte"=>10],false);
        Validation::validateStringLength($errors,$body,'buyerName',["gte"=>3,"lte"=>50],true);
        Validation::validateStringLength($errors,$body,'token',["gte"=>32,"lte"=>32],true);
        Validation::validateIsNumeric($errors,$body,'buyerDocument',true);
        Validation::validateStringLength($errors,$body,'buyerDocument',["gte"=>6,"lte"=>15],true);


        if(!empty($errors)){
            throw new GeneralException("Datos inválidos",$errors);
        }
    }

}
