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
     * @param $params
     * @return mixed
     */
    public function persist(IForm $request);

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
     * @param $params
     * @return mixed
     */
    public function search(IListForm $params = null);
}