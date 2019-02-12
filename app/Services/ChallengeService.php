<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ChallengeRepo;
use App\Repositories\UserRepo;

/**
 * Class ChallengeService
 * @package App\Services
 * @author Umar Farooq
 */
class ChallengeService extends BaseService {

    /**
     * @param $params
     * @return mixed
     */
    public function persist($params)
    {
        if(!$this->validate($params)){
        }
        // validation params ???
        $users = User::all(['active' => true]);
        $this->repo->activeOnly(  );

        // TODO: Implement persist() method.
    }

    public function update_name($params){

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