<?php

namespace App\Http\Controllers;

use App\Helper\GeneralResponse;


use App\Services\Login\LoginService;
use App\Services\Login\ValidationLoginService;
use App\Services\User\BalanceService;
use App\Services\User\RegisterServices\RegisterUserService;
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
            $user = RegisterUserService::registerUser($body);
            return GeneralResponse::buildResponse("true","Usuario registrado con éxito",[$user]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function loginUser(Request $request){
        try{
            $auth = $request->header('Authorization', '');
            $credentials = ValidationLoginService::validate($auth);
            $userData = LoginService::login($credentials);
            return GeneralResponse::buildResponse("true","Bienvenido",[$userData]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function getBalance(Request $request){
        try{
            $body = $request->request->all();
            $balance = BalanceService::getBalance($body);
            return GeneralResponse::buildResponse("true","Usuario registrado con éxito",[$balance]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

}
