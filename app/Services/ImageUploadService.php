<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/27/19
 * Time: 5:21 PM
 */

namespace App\Services;


use App\Models\Image;

class ImageUploadService
{
    private $user;

    public function __construct(UserService $userService)
    {
        $this->user  = $userService;
    }

    public function uploadProfile($profile, $user_id){
        $file = $this->uploadImages($profile, $user_id);
        $image = $this->storeImage($file, $user_id);
        return $image;
    }

    /**
     * @param $file
     * @return Image
     */
    public function storeImage($file, $id){
        $user = $this->user->findById($id);
        $image = new Image();
        $image->storage_path = 'storage/images/profiles/'.$user['id'].'/';
        $image->data         = json_encode($file['path']);
        $image->name         = $file['name'];

        $user->profileImage()->save($image);
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
}