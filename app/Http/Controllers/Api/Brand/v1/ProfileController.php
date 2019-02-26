<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 7:39 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Forms\Auth\PasswordForm;
use App\Forms\Auth\ProfileForm;
use App\Forms\Auth\ProfileImageForm;
use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use App\Http\Resources\Profile;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Brand\v1
 *
 *
 */
class ProfileController extends Controller
{
    private $userService;
    private $profileService;
    private $jwtAuth;

    /**
     * ProfileController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service, ProfileService $profileService, JWTAuth $jwt)
    {
        $this->userService = $service;
        $this->profileService = $profileService;
        $this->jwtAuth = $jwt;
    }

    /**
     * @param Request $request
     * @return Profile
     */
    public function index(Request $request){
        $user = $this->userService->findById(  $this->currentUser() );
        return new Profile( $user );
    }

    /**
     * @param Request $request
     * @return \App\Models\User|\Exception|\Illuminate\Auth\AuthenticationException|\Illuminate\Contracts\Auth\Authenticatable|null
     * @throws ValidationException
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