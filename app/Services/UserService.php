<?php

namespace App\Services;

use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 * @author Umar Farooq
 */
class UserService extends BaseService {

    /**
     * @param $params
     * @return mixed
     */
    public function persist($params)
    {
        $entity = new User();

        // TODO: Implement persist() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        // TODO: Implement findById() method.
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
     * @param $params
     * @return mixed
     */
    public function search($params)
    {
        // TODO: Implement search() method.
    }
}