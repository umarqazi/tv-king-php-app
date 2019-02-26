<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 11:36 AM
 */

namespace App\Http\Controllers\Api\Admin\v1;


use App\Forms\Auth\PasswordForm;
use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Admin\v1
 *
 *
 */
class ProfileController extends Controller
{
    private $profileService;
    private $jwtAuth;

    public function __construct(ProfileService $service, JWTAuth $jwt)
    {
        $this->profileService = $service;
        $this->jwtAuth = $jwt;
    }

    public function password(Request $request){
        $form = new PasswordForm();
        $form->old_password             = $request['old_password'];
        $form->password                 = $request['password'];
        $form->password_confirmation    = $request['password_confirmation'];
        $user = $this->profileService->asAdmin($form);
        return $user;
    }

    /**
     * @param Request $request
     */
    public function image(Request $request){

    }

    /**
     * @param Request $request
     */
    public function personal(Request $request){

    }
}