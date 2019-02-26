<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 7:39 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Forms\Auth\PasswordForm;
use App\Forms\Auth\ProfileImageForm;
use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Brand\v1
 *
 *
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
     * @return \App\Models\User|\Exception|\Illuminate\Auth\AuthenticationException|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function password(Request $request){
        $form = new PasswordForm();
        $form->old_password             = $request['old_password'];
        $form->password                 = $request['password'];
        $form->password_confirmation    = $request['password_confirmation'];
        $user = $this->profileService->asBrand($form);
        return $user;
    }

    public function image(Request $request){
        $form = new ProfileImageForm();
        $form->profile = $request['profile'];
//        $user = $this->profileService->
    }

    /**
     * @param Request $request
     */
    public function personal(Request $request){

    }
}