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
use App\Http\Resources\Image;
use App\Services\ProfileService;
use App\Http\Resources\Profile;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * ProfileController constructor.
     * @param UserService $service
     * @param ProfileService $profileService
     */
    public function __construct(UserService $service, ProfileService $profileService)
    {
        $this->userService = $service;
        $this->profileService = $profileService;
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
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
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
        $form->user_id = $this->currentUser();
        $profileImage = $this->profileService->image($form);
        return new Image($profileImage);
    }

    /**
     * @param Request $request
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function profile(Request $request){
        $form = new ProfileForm();
        $form->first_name = $request['first_name'];
        $form->last_name  = $request['last_name'];
        $form->user_id    = $this->currentUser();
        $user = $this->profileService->profile($form);
        return new Profile($user);
    }
}