<?php

namespace App\Services;

use App\Http\Requests\UserSignup;

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
    public function persist($params);

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
    public function search($params);
}