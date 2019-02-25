<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IListForm;
use App\Models\User;
use App\Forms\IForm;

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
    public function findById($id)
    {
        return User::query()->findOrFail($id);
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
     * @param IListForm $form
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form = null)
    {
        // TODO: Implement search() method.
    }
}