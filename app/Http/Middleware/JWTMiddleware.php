<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class JWTMiddleware
{

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function handle($request, Closure $next, $guard = null)
    {
        try{
            $bearer = explode("Bearer ",$this->request->header('Authorization',''));
            if(count($bearer)!=2){
                throw  new \Exception("Authorization invalid");
            }
            $payload = JWT::decode($bearer[1], env('JWT_KEY'), array('HS256'));
            $request->request->add(["userId"=>$payload->sub]);
        }catch(\Exception $ex){
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
