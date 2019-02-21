<?php

namespace App\Http\Controllers\Api\Brand\v1;

use App\Http\Requests\UserSignup;
use App\Services\SignupService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 * Class SignupController
 * @package App\Http\Controllers\Api\Brand\v1
 *
 * api/brand/v1/signup
 */
class SignupController extends Controller
{
    protected $signup_service;

    public function __construct(SignupService $signupService)
    {
        $this->signup_service = $signupService;
    }

    /**
     * @SWG\Post(
     *   path="/brand/v1/signup",
     *   summary="Brand Sign Up",
     *   operationId="register",
     *   produces={"application/json"},
     *   tags={"Brand"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="formData",
     *     description="Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(Request $request){
        /**
         * Validations are done...
         */

        $response = $this->signup_service->asBrand($request->all());
        return $response;
    }

    /**
     * @SWG\Post(
     *   path="/brand/v1/login",
     *   summary="Brand Login",
     *   operationId="login",
     *   produces={"application/json"},
     *   tags={"Brand"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function login(Request $request){
        $response = $this->signup_service->login($request->all());
        return $response;
    }

    /**
     * @SWG\Post(
     *   path="/brand/v1/logout",
     *   summary="Brand Logout",
     *   operationId="logout",
     *   produces={"application/json"},
     *   tags={"Brand"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Auth Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function logout(Request $request){
        $response = $this->signup_service->logout($request->all());
        return $response;
    }

    /**
     * @SWG\Post(
     *   path="/brand/v1/password/reset",
     *   summary="Brand Password Reset",
     *   operationId="passwordReset",
     *   produces={"application/json"},
     *   tags={"Brand"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Auth Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="prev_password",
     *     in="formData",
     *     description="Previous Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="formData",
     *     description="Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function passwordReset(Request $request){
        $response = $this->signup_service->passwordReset($request->all());
        return $response;
    }
}
