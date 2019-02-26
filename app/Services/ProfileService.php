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

    /**
     * ProfileService constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
        $user = auth()->user();

        $profile  = Input::file('profile');
        $file     = $this->uploadImage($profile,$user['id']);
        $image    = $this->userService->storeImage($file);
        return $image;
    }

    /**
     * @param $data
     * @param $user_id
     * @return array
     */
    public function uploadImage($data, $user_id){
        $fileName   = $data->getClientOriginalName();

        $img = Image::make($data->getRealPath());
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $filePath='images/'.$user_id.'/profile_image/'.$fileName;
        Storage::disk('public')->put($filePath, $img);
        return array('path' => $filePath, 'name' => $fileName);
    }

    /**
     * @param ProfileForm $form
     * @return User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function profile(ProfileForm $form){
        $form->validate();
        $user = auth()->user();
        $user = $this->userService->updateProfile($user['id'],$form);
        return $user;
    }
}