<?php

namespace App\Http\Middleware;

use App\Helpers\User;
use Closure;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class BrandAuthenticator
 * @package App\Http\Middleware
 */
class BrandAuthenticator extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = $this->auth->parseToken()->authenticate();
            if( User::isBrand($user) === false){
                return response()->json(['status' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'], Response::HTTP_UNAUTHORIZED);
            }else{
                return response()->json(['status' => 'Authorization Token not found'], Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
