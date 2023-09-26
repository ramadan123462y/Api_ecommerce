<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwtadmin
{
    use ApiResponse;
      public function handle(Request $request, Closure $next)
    {



        try {

            if (empty($request->token)) {


                return response(["please check token in header and login activitie"], 401);
            }
            if(Auth::guard('apiadmin')->check()){
                return $next($request);
            }else{

                return $this->api([],401,["un uthorization"]);

            }




        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->api(null, 400, ["token in valid"]);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return  $this->api(null, 400, ["token in expired"]);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                return $this->api(null, 400, ["token in valid"]);
            } else {
                return $this->api(null, 400, ["token in valid"]);
            }
        }
    }

}
