<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 11:36 AM
 */

namespace App\Http\Controllers\Api\Admin\v1;


use App\Forms\Auth\PasswordForm;
use App\Forms\Auth\ProfileForm;
use App\Forms\Auth\ProfileImageForm;
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

    public function index(){

    }

    /**
     * @param Request $request
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function password(Request $request){
        $form = new PasswordForm();
        $form->old_password             = $request['old_password'];
        $form->password                 = $request['password'];
        $form->password_confirmation    = $request['password_confirmation'];
        $user = $this->profileService->password($form);
        return $user;
    }

    /**
     * @param Request $request
     * @return \App\Models\Image
     */
    public function image(Request $request){
        $form = new ProfileImageForm();
        $form->profile = $request['profile'];
        $user = $this->profileService->image($form);
        return $user;
    }

    /**
     * @param Request $request
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function profile(Request $request){
        $form = new ProfileForm();
        $form->first_name = $request['first_name'];
        $form->last_name  = $request['last_name'];
        $user = $this->profileService->profile($form);
        return $user;
    }
}