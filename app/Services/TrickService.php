<?php

namespace App\Services;

use App\Repositories\TrickRepo;

/**
 * Class TrickService
 * @package App\Services
 * @author Umar Farooq
 */
class TrickService extends BaseService {

    /**
     * @var TrickRepo
     */
    protected $trick_repo;

    /**
     * TrickService constructor.
     * @param TrickRepo $trick_repo
     */
    public function __construct(TrickRepo $trick_repo)
    {
        $this->trick_repo = $trick_repo;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function persist($params)
    {
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