<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IListForm;
use App\Forms\SearchForm;
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
     * @var null
     */
    public $user_type = null;

    /**
     * UserService constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param IForm $form
     * @return mixed|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function persist(IForm $form)
    {
        $form->validate();
        $user = new User();
        $user->first_name = $form->firstName;
        $user->last_name = $form->lastName;
        $user->email = $form->email;
        $user->user_type = $form->user_type;
        $user->password = Hash::make($form->password);
        $user->save();
        return $user;
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
        if(blank($this->user_type)){
            return User::query()->findOrFail($id);
        }
        return User::query()->where(['id' => $id, 'user_type' => $this->user_type])->firstOrFail();
    }

    /**
     * @param BaseListForm|null $form
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form = null)
    {
        /** @var SearchForm $form */
        $query = User::query();
        $query->when($form->user_type, function($query, $user_type){
            $query->where(['user_type' => $user_type]);
        });
        return $query->orderBy($form->sortBy, $form->sortOrder)->paginate($form->itemPerPage);
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
     * @param User $user
     * @return Image
     */
    public function storeImage($file, $user){
        $image = $user->profileImage;
        if($image === null){
            $image = new Image();
        }
        $image->storage_path = $file['storage_path'];
        $image->data         = $file['path'];
        $image->name         = $file['name'];
        $image->web_path = $file['web_path'];
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