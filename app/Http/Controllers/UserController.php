<?php

namespace App\Http\Controllers;

use App\Helper\GeneralResponse;

use App\Services\User\RegisterServices\ValidationRegisterUserService;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

class UserController extends BaseController
{
    public function registerUser(Request $request){

        try{
            $body = $request->request->all();
            ValidationRegisterUserService::validate($body);

            return GeneralResponse::buildResponse("true","Usuario registrado con éxito",[]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }
}
