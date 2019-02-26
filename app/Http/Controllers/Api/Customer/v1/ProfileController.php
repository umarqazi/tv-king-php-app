<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 7:39 PM
 */

namespace App\Http\Controllers\Api\Customer\v1;


use App\Forms\Auth\PasswordForm;
use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Customer\v1
 */
class ProfileController extends Controller
{
    /**
     * @var ProfileService
     */
    private $profileService;
    private $jwtAuth;

    /**
     * ProfileController constructor.
     * @param ProfileService $service
     * @param JWTAuth $jwt
     */
    public function __construct(ProfileService $service, JWTAuth $jwt)
    {
        $this->profileService = $service;
        $this->jwtAuth = $jwt;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function password(Request $request){
        $form = new PasswordForm();
        $form->old_password             = $request['old_password'];
        $form->password                 = $request['password'];
        $form->password_confirmation    = $request['password_confirmation'];
        $user = $this->profileService->asCustomer($form);
        return $user;
    }

    /**
     * @param Request $request
     */
    public function show(Request $request){

    }

    /**
     * @param Request $request
     */
    public function profile(Request $request){

    }

}