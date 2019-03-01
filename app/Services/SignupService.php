<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 9:40 PM
 */

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IForm;
use App\Forms\IListForm;
use App\Http\Requests\UserSignup;
use \App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class SignupService extends BaseService
{
    public $service;
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * @param IForm $form
     * @return User|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function persist(IForm $form)
    {
        $user = $this->service->persist($form);
        return $user;
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
     * @param IListForm $form
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form)
    {
        // TODO: Implement search() method.
    }
}