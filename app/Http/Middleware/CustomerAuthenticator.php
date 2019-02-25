<?php

namespace App\Http\Middleware;

use App\Helpers\User;
use App\Services\IUserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class CustomerAuthenticator
 * @package App\Http\Middleware
 */
class CustomerAuthenticator extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->auth->parseToken()->authenticate();
        if( User::isCustomer($user) === true){
            return $next($request);
        }
        return response()->json(['status' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED);
    }
}
