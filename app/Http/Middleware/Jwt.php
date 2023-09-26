<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwt
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        try {
            if(empty($request->header('token'))){
                return response(["please check token in header and login activitie"],401);
            }
            if ($user = JWTAuth::setToken($request->header('token'))->authenticate()) {
                return $next($request);
            }else{

                return response(["please check token in header and login activitie"],401);
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
        //
    }
}
