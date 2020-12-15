<?php

namespace App\Services\User\RegisterServices;

use App\Exceptions\GeneralException;
use App\Helper\Validation;

class ValidationRegisterUserService{

    public static function validate($body){

        $errors = [];

        Validation::validateEmail($errors, $body, 'email', true);
        Validation::validateStringLength($errors,$body,'firstName',["gte"=>3,"lte"=>50],true);
        Validation::validateStringLength($errors,$body,'lastName',["gte"=>3,"lte"=>50],true);
        Validation::validateStringLength($errors,$body,'phone',["gte"=>8,"lte"=>10],true);
        Validation::validateStringLength($errors,$body,'document',["gte"=>6,"lte"=>12],true);
        Validation::validateStringLength($errors,$body,'password',["gte"=>8,"lte"=>20],true);

        if(!empty($errors)){
            throw new GeneralException("Datos inválidos",$errors);
        }
    }

}
