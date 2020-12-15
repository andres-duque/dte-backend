<?php

namespace App\Services\Login;

use App\Exceptions\GeneralException;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class LoginService{

    public static function login($credentials){

        $user = User::where('email',$credentials["email"])->first();

        if(!isset($user) || $credentials["password"] != Crypt::decrypt($user->password)){
            throw new GeneralException("Usuario o clave inválida");
        }

        $tokenPayload = [
            "iss"=>"dteBackend",
            "sub"=>$user->id,
            "iat"=>time(),
            "exp"=>time() + 60 * 60,
        ];

        $token = JWT::encode($tokenPayload,env("JWT_KEY"));

        return [
            "firstName"=>$user->firstName,
            "lastName"=>$user->lastName,
            "balance"=>$user->balance,
            "token"=>$token
        ];

    }

}
