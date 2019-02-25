<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Forms\Auth\LoginForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Profile;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;


/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Admin\v1
 *
 */
class LoginController extends Controller
{

    /**
     * @var AuthenticationService
     */
    private $authService;

    /**
     * @var JWTAuth
     */
    private $jwt;

    /**
     * LoginController constructor.
     * @param AuthenticationService $authService
     */
    public function __construct(AuthenticationService $authService, JWTAuth $jwt)
    {
        $this->authService = $authService;
        $this->jwt = $jwt;
    }

    /**
     * @param Request $request
     *
     */
    public function index(Request $request){
        $form = new LoginForm();
        $form->email = $request->post('email', null);
        $form->password = $request->post('password', null);

        $account = $this->authService->asAdmin($form);
        $token = $this->jwt->fromUser($account);

        $response = [
            'user' => new Profile($account),
            'token' => $token
        ];
        $headers = [
            'X-TV-TOKEN' => $token
        ];
        return response()->json( $response , 200, $headers);
    }


}