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
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->parseToken()->authenticate();
        if (User::isBrand($user) === true) {
            return $next($request);
        }
        return response()->json(['errors' => ['token' => 'Token is Invalid'] ], Response::HTTP_UNAUTHORIZED);
    }
}
