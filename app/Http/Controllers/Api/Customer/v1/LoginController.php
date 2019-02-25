<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 11:28 AM
 */

namespace App\Http\Controllers\Api\Customer\v1;

use App\Forms\Auth\LoginForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Profile;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Api\Customer\v1
 *
 */
class LoginController extends Controller
{

    /**
     * @var
     */
    private $authService;
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

        $customer = $this->authService->asCustomer($form);
        $token = $this->jwt->fromUser($customer);

        $response = [
            'user' => new Profile($customer),
            'token' => $token
        ];
        $headers = [
            'X-TV-TOKEN' => $token
        ];
        return response()->json( $response , 200, $headers);
    }


}