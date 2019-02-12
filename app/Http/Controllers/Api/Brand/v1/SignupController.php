<?php

namespace App\Http\Controllers\Api\Brand\v1;

use App\Http\Requests\BrandSignup;
use App\Services\SignupService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     *   path="/api/brand/v1/signup",
     *   summary="Register",
     *   operationId="register",
     *   @SWG\Parameter(
     *     name="first_name",
     *     in="formData",
     *     description="Brand First Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="last_name",
     *     in="formData",
     *     description="Brand Last Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Brand Email",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(BrandSignup $request){
        /**
         * Validations are done...
         */
        $this->signup_service;
    }
}
