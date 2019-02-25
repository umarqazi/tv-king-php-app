<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 11:28 AM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Forms\Auth\LoginForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Profile;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Brand\v1
 *
 */
class LoginController extends Controller
{

    /**
     * @var AuthenticationService
     */
    private $authService;
    private $jwtAuth;

    /**
     * LoginController constructor.
     * @param AuthenticationService $service
     */
    public function __construct(AuthenticationService $service, JWTAuth $jwt)
    {
        $this->authService = $service;
        $this->jwtAuth = $jwt;
    }

    /**
     * @param Request $request
     *
     */
    public function index(Request $request){
        $form = new LoginForm();
        $form->email = $request['email'];
        $form->password = $request['password'];
        $user = $this->authService->asBrand($form);
        $jwtToken = $this->jwtAuth->fromUser($user);
        $response = [
            'user' => new Profile($user),
            'token' => $jwtToken,
            "token_type" => "bearer",
        ];
        return response()->json($response, 200, ['TOKEN' => $jwtToken]);
    }
}