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
        $profile  = Input::file('profile');

        $user = $this->userService->findById($form->user_id);
        $savedProfileImage = $user->profileImage;
        if($savedProfileImage !== null){
            Storage::deleteDirectory($savedProfileImage->storage_path);
        }
        $file     = $this->uploadImages($profile, $form->user_id);
        $image    = $this->userService->storeImage($file, $user );
        return $image;
    }

    /**
     * @param $data
     * @param $user_id
     * @return array
     */
    public function uploadImages($data, $user_id){
        $fileName   = uniqid('profile-') . '.' . $data->getClientOriginalExtension();
        $ext        = $data->getClientOriginalExtension();
        $storagePath   = 'storage/images/profiles/'. uniqid() .'/';
        Storage::makeDirectory($storagePath);

        $img = Image::make($data->getRealPath());

        // Save Image In Original Size
        $img->stream();
        $originalImage = $storagePath.$fileName;
        Storage::disk('public')->put($originalImage, $img);

        // Save Small Image
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $smallFilePath = $storagePath.'small-'.$fileName;
        Storage::disk('public')->put($smallFilePath, $img);

        // Save Medium Image
        $img->resize(240, 180, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $mediumFilePath = $storagePath.'medium-'.$fileName;
        Storage::disk('public')->put($mediumFilePath, $img);

        // Save Large Image
        $img->resize(480, 360, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->stream();
        $largeFilePath = $storagePath.'large-'.$fileName;
        Storage::disk('public')->put($largeFilePath, $img);

        $path = [
            'small' => Storage::url($smallFilePath),
            'medium' => Storage::url($mediumFilePath),
            'large' => Storage::url($largeFilePath),
            'original' => Storage::url($originalImage)
        ];

        return ['path' => $path,
            'storage_path' => $storagePath,
            'web_path' => Storage::url($originalImage),
            'name' => $fileName];
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