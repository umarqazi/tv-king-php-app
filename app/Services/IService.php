<?php

namespace App\Services;

use App\Forms\IListForm;
use App\Http\Requests\UserSignup;
use App\Forms\IForm;

/**
 * Interface IService
 * @package App\Services
 *
 */
interface IService{

    /**
     * @param IForm $form
     * @return mixed
     */
    public function persist(IForm $form);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id);

    /**
     * @param IListForm $form
     * @return mixed
     */
    public function search(IListForm $form = null);
}