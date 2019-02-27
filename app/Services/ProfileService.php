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
     * @param ImageUploadService $imageUploadService
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
        $profile  = Input::file('profile');
        $file     = $this->uploadImages($profile,$form->user_id);
        $image    = $this->userService->storeImage($file,$form->user_id );
        return $image;
    }

    /**
     * @param $data
     * @param $user_id
     * @return array
     */
    public function uploadImages($data, $user_id){
        $fileName   = $data->getClientOriginalName();
        $ext        = $data->getClientOriginalExtension();
        $filePath   = 'images/profiles/'.$user_id.'/';
        $img = Image::make($data->getRealPath());

        // Save Image In Original Size
        $img->stream();
        Storage::disk('public')->put($filePath.$fileName, $img);

        // Save Small Image
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $smallFilePath = $filePath.'small/'.$fileName;
        Storage::disk('public')->put($smallFilePath, $img);

        // Save Medium Image
        $img->resize(240, 180, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $mediumFilePath = $filePath.'medium/'.$fileName;
        Storage::disk('public')->put($mediumFilePath, $img);

        // Save Large Image
        $img->resize(480, 360, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $largeFilePath = $filePath.'large/'.$fileName;
        Storage::disk('public')->put($largeFilePath, $img);

        $path = array('small' => $smallFilePath, 'medium' => $mediumFilePath, 'large' => $largeFilePath, 'original' => $filePath);
        return array('path' => $path, 'name' => $fileName);
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