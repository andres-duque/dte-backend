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

}
