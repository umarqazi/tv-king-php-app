<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserSignup;
use App\Services\SignupService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserSignupController extends Controller
{
    protected $signup_service;

    public function __construct(SignupService $signupService)
    {
        $this->signup_service = $signupService;
    }

    /**
     * @SWG\Post(
     *   path="/signup",
     *   summary="User Sign Up",
     *   operationId="register",
     *   produces={"application/json"},
     *   tags={"Users"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="User Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="User Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="user_type",
     *     in="formData",
     *     description="User Type",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="User Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password_confirmation",
     *     in="formData",
     *     description="User Confirm Password",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(UserSignup $request){
        /**
         * Validations are done...
         */
        $this->signup_service->persist2($request);
    }
}
