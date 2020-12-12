<?php

namespace App\Services\User\RegisterServices;

use Illuminate\Support\Facades\Crypt;
use App\Exceptions\GeneralException;
use App\Helper\GeneralResponse;
use App\Models\User;

class RegisterUserService{

    public static function registerUser($body){
        $emailExist = User::where('email',$body["email"])->first();
        if(isset($emailExist)){
            throw  new GeneralException("Correo ya existe",[]);
        }

        $documentExist = User::where('document',$body["document"])->first();
        if(isset($documentExist)){
            throw new GeneralException("Documento ya existe",[]);
        }

        $user = new User;
        $user->firstName = $body["firstName"];
        $user->lastName = $body["lastName"];
        $user->phone = $body["phone"];
        $user->document = $body["document"];
        $user->email = $body["email"];
        $user->password = Crypt::encrypt($body["password"]);
        $user->save();

        return $user->toArray();
    }

}
