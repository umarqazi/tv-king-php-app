<?php

namespace App\Http\Controllers\Api\Brand\v1;

use App\Forms\User\CreatorForm;
use App\Http\Requests\UserSignup;
use App\Services\IUserType;
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
 *
 */
class SignupController extends Controller
{
    protected $signup_service;

    public function __construct(SignupService $signupService)
    {
        $this->signup_service = $signupService;
    }

    public function register(Request $request){
        $form = new CreatorForm();
        $form->firstName = $request['first_name'];
        $form->lastName = $request['last_name'];
        $form->email = $request['email'];
        $form->user_type = IUserType::BRAND;
        $form->password = $request['password'];
        $form->password_confirmation = $request['password_confirmation'];
        $brand = $this->signup_service->persist($form);
        return $brand;
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
        $response = $this->signup_service->loginAsBrand($request->all());
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
     *   path="/brand/v1/change-password",
     *   summary="Brand Change Password",
     *   operationId="changePassword",
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
    public function changePassword(Request $request){
        $response = $this->signup_service->passwordReset($request->all());
        return $response;
    }
}
