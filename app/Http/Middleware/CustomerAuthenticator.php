<?php

namespace App\Http\Middleware;

use App\Services\IUserType;
use Closure;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;

class CustomerAuthenticator
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
        $user = auth()->user();
        if ($user['user_type'] == IUserType::CUSTOMER) {
            return $next($request);
        } else{
            /**
             *
             */
        }
    }
}
