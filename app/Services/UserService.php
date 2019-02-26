<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IListForm;
use App\Models\Image;
use App\Models\User;
use App\Forms\IForm;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 * @author Umar Farooq
 */
class UserService extends BaseService implements IUserType {


    /**
     * @param IForm $form
     * @return mixed
     */
    public function persist(IForm $form)
    {
        $form->validate();
        // TODO: Implement persist() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        // TODO: Implement remove() method.
    }

    /**
     * @param $id
     * @return User
     */
    public function findById($id)
    {
        return User::query()->findOrFail($id);
    }

    /**
     * @param IListForm $form
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form = null)
    {
        // TODO: Implement search() method.
    }

    /**
     * @param $user_id
     * @param $plain_password
     * @return User
     */
    public function changePassword($user_id, $plain_password){
        $user = $this->findById($user_id);
        $user->password = Hash::make($plain_password);
        $user->save();
        $user->refresh();
        return $user;
    }

    /**
     * @param $file
     * @return Image
     */
    public function storeImage($file){
        $user = auth()->user();
        $image = new Image();
        $image->storage_path = storage_path('app/public/').$file['path'];
        $image->name         = $file['name'];

        $user->profileImage()->save($image);
        return $image;
    }

    /**
     * @param $id
     * @param $params
     * @return User
     */
    public function updateProfile($id,$form){
        $user = $this->findById($id);
        $user->first_name = $form->first_name;
        $user->last_name  = $form->last_name;
        $user->save();
        return $user;
    }
}