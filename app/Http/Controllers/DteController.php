<?php

namespace App\Http\Controllers;

use App\Helper\GeneralResponse;
use App\Services\Dte\ListDteService;
use App\Services\Dte\PayDteService;
use App\Services\Dte\ValidationPayDte;
use App\Services\Dte\CreateDteService;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;

class DteController extends BaseController
{
    public function createDte(Request $request){

        try{
            $body = $request->request->all();
            $body["ip"] = $request->ip();
            ValidationCreateDte::validate($body);
            $dte = CreateDteService::create($body);
            return GeneralResponse::buildResponse("true","Factura creada con éxito",[$dte]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function listDte(Request $request){

        try{
            $body = $request->request->all();
            $dte = ListDteService::listDte($body);
            return GeneralResponse::buildResponse("true","Facturas listadas con éxito",[$dte]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function getDteByToken(Request $request,$token){
        try{
            $dte = ListDteService::listDteByToken($token);
            return GeneralResponse::buildResponse("true","Factura listada con éxito",[$dte]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }

    public function payDte(Request $request){

        try{
            $body = $request->request->all();
            $body["ip"] = $request->ip();
            ValidationPayDte::validate($body);
            $dte = PayDteService::pay($body);
            return GeneralResponse::buildResponse("true","Factura creada con éxito",[$dte]);
        }catch (GeneralException $e){
            return GeneralResponse::buildResponse(false,$e->getMessage(),$e->getData());
        }
    }
}
