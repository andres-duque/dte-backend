<?php

namespace App\Http\Controllers;

use App\Helper\GeneralResponse;
use App\Services\Dte\ValidationCreateDte;
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

}
