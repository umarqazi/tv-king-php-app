<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IForm;
use App\Forms\IListForm;
use App\Models\Challenge;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ChallengeService
 * @package App\Services
 * @author Umar Farooq
 */
class ChallengeService extends BaseService{

    /**
     * @param $params
     * @return mixed
     */
    public function persist(IForm $request)
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
    public function search(BaseListForm $form = null)
    {
        // TODO: Implement search() method.
    }
}