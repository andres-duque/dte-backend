<?php

namespace App\Services\Login;

use App\Exceptions\GeneralException;
use App\Helper\Validation;

class ValidationLoginService{

    public static function validate($auth){

        $errors = [];
        $auth = explode("Basic ",$auth);
        if(count($auth)!=2){
            throw  new GeneralException("Email y Contraseña requeridos",[]);
        }

        $auth = explode(":",base64_decode($auth[1]));
        if(count($auth)!=2){
            throw  new GeneralException("Email y Contraseña requeridos",[]);
        }

        $email = $auth[0];
        $password = $auth[1];

        $credentials = [
            "email"=>$email,
            "password"=>$password
        ];
        Validation::validateEmail($errors, $credentials, 'email', true);
        Validation::validateStringLength($errors,$credentials,'password',["gte"=>8,"lte"=>20],true);

        if(!empty($errors)){
            throw new GeneralException("Credenciales inválidas",$errors);
        }

        return $credentials;
    }

}
