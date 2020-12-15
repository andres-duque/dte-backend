<?php

namespace App\Helper;

class Validation{

    public static function validateEmail(&$error,$body,$key,$required=false){
        if(isset($body[$key])){
            if(!filter_var($body[$key], FILTER_VALIDATE_EMAIL)){
                $error[] = [
                    "message"=>"Parámetro email inválido"
                ];
            }
        }else{
            if($required){
                $error[] = [
                    "message"=>"Parámetro $key requerido"
                ];
            }
        }
    }

    public static function validateEmptyString(&$error,$body,$key,$required=false){
        if(isset($body[$key])){
            if(strlen(trim($body[$key]))==0){
                $error[] = [
                    "message"=>"Parámetro $key inválido"
                ];
            }
        }else{
            if($required){
                $error[] = [
                    "message"=>"Parámetro $key requerido"
                ];
            }
        }
    }

    public static function validateStringLength(&$error,$body,$key,$range,$required=false){
        if(isset($body[$key])){
            if(strlen(trim($body[$key]))>$range["lte"] || strlen(trim($body[$key]))<$range["gte"]){
                $error[] = [
                    "message"=>"Parámetro $key inválido, debe contener de ".$range["gte"]." a ".$range["lte"]." caracteres"
                ];
            }
        }else{
            if($required){
                $error[] = [
                    "message"=>"Parámetro $key requerido"
                ];
            }
        }
    }

    public static function validateNumberRange(&$error,$body,$key,$range,$required=false){
        if(isset($body[$key])){
            if(is_numeric($body[$key])){
                if($body[$key]>$range["lte"] || $body[$key]<$range["gte"]){
                    $error[] = [
                        "message"=>"Parámetro $key inválido, el valor debe ser mayor a  ".$range["gte"]." y menor a  ".$range["lte"]
                    ];
                }
            }else{
                $error[] = [
                    "message"=>"Parámetro $key inválido, el valor debe ser numérico"
                ];
            }

        }else{
            if($required){
                $error[] = [
                    "message"=>"Parámetro $key requerido"
                ];
            }
        }
    }

    public static function validateIsNumeric(&$error,$body,$key,$required=false){
        if(isset($body[$key])){
            if(!is_numeric($body[$key])){
                $error[] = [
                    "message"=>"Parámetro $key inválido, el valor debe ser numérico"
                ];
            }elseif ($body[$key]<0){
                $error[] = [
                    "message"=>"Parámetro $key inválido, el valor debe ser mayor a 0"
                ];
            }
        }else{
            if($required){
                $error[] = [
                    "message"=>"Parámetro $key requerido"
                ];
            }
        }
    }

    public static function validateIsBoolean($error,$body,$key,$required=false){
        if(isset($body[$key])){
            if(!is_bool($body[$key])){
                $error[] = [
                    "message"=>"Parámetro $key inválido, el valor debe ser booleano"
                ];
            }

        }else{
            if($required){
                $error[] = [
                    "message"=>"Parámetro $key requerido"
                ];
            }
        }
    }

    public static function validateIsSet($data,$key,$default=""){

        $content = $default;

        if (isset($data[$key])) {
            $content=$data[$key];
        }

        return $content;
    }

}
