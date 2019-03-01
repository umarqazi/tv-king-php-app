<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Forms\User\CreatorForm;
use App\Http\Requests\UserSignup;
use App\Services\IUserType;
use App\Services\SignupService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignupController extends Controller
{
    protected $signup_service;

    public function __construct(SignupService $signupService)
    {
        $this->signup_service = $signupService;
    }

    /**
     * @SWG\Post(
     *   path="/admin/v1/signup",
     *   summary="Admin Sign Up",
     *   operationId="register",
     *   produces={"application/json"},
     *   tags={"Admin"},
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
        $form = new CreatorForm();
        $form->firstName = $request['first_name'];
        $form->lastName = $request['last_name'];
        $form->email = $request['email'];
        $form->user_type = IUserType::ADMIN;
        $form->password = $request['password'];
        $form->password_confirmation = $request['password_confirmation'];
        $admin = $this->signup_service->persist($form);
        return $admin;
    }

    /**
     * @SWG\Post(
     *   path="/admin/v1/login",
     *   summary="Admin Login",
     *   operationId="login",
     *   produces={"application/json"},
     *   tags={"Admin"},
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
        $response = $this->signup_service->loginAsAdmin($request->all());
        return $response;
    }

    /**
     * @SWG\Post(
     *   path="/admin/v1/logout",
     *   summary="Admin Logout",
     *   operationId="logout",
     *   produces={"application/json"},
     *   tags={"Admin"},
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
     *   path="/admin/v1/change-password",
     *   summary="Admin Change Password",
     *   operationId="changePassword",
     *   produces={"application/json"},
     *   tags={"Admin"},
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
