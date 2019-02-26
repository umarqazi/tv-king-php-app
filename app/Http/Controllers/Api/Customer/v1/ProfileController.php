<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 7:39 PM
 */

namespace App\Http\Controllers\Api\Customer\v1;


use App\Forms\Auth\PasswordForm;
use App\Forms\Auth\ProfileForm;
use App\Forms\Auth\ProfileImageForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Profile;
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

    /**
     * ProfileController constructor.
     * @param ProfileService $service
     */
    public function __construct(ProfileService $service)
    {
        $this->profileService = $service;
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
     * @return Profile
     */
    public function show(Request $request){
        $profile = $this->profileService->view( $this->currentUser() );
        return new Profile($profile);
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

}