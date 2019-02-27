<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/25/19
 * Time: 8:01 PM
 */

namespace App\Services;
use App\Forms\Auth\PasswordForm;
use App\Forms\Auth\ProfileForm;
use App\Forms\Auth\ProfileImageForm;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileService
{
    /**
     * @var UserService
     */
    private $userService;
    private $imageUploadService;

    /**
     * ProfileService constructor.
     * @param UserService $userService
     * @param ImageUploadService $imageUploadService
     */
    public function __construct(UserService $userService, ImageUploadService $imageUploadService)
    {
        $this->userService = $userService;
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * @param PasswordForm $form
     * @return User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function password(PasswordForm $form){
        $form->validate();
        $user = auth()->user();
        /** @var $user User*/
        $user = $this->userService->changePassword($user->getAuthIdentifier(), $form->password);
        return $user;
    }

    /**
     * @param ProfileImageForm $form
     * @return \App\Models\Image
     */
    public function image(ProfileImageForm $form){
        $form->validate();
        $profile  = Input::file('profile');
        $image    = $this->imageUploadService->uploadProfile($profile, $form->user_id);
        return $image;
    }

    /**
     * @param ProfileForm $form
     * @return User
     */
    public function profile(ProfileForm $form){
        $form->validate();
        $user = $this->userService->updateProfile($form->user_id,$form);
        return $user;
    }
}