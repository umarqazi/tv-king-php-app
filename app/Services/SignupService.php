<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 9:40 PM
 */

namespace App\Services;

use App\Http\Requests\UserSignup;
use \App\Models\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupService extends BaseService
{
    /**
     * @var User
     */
    protected $user;

    /**
     * SignupService constructor.
     * @param User $user
     */
    public function __construct()
    {

    }


    public function asBrand($params){
        $userService = new UserService();
        $userParams = [];
        $userParams['user_type'] = $params['2'];
        $user = $userService->persist($params);
    }


    public function persist2(UserSignup $request){
        return $this->validateRequest($request->all(), $request->rules());
    }

    /**
     * @param $params
     * @return mixed
     */
    public function persist($params)
    {
        $rules = [
            'name'      => 'required|max:191',
            'email'     => 'required|email|max:191',
            'user_type' => 'required|integer',
            'password'  => 'required|min:8|confirmed',
        ];

        return $this->validateRequest($params, $rules);
    }

    public function validateRequest($params, $rules){
        $validator = Validator::make($params, $rules);

        $errors = $validator->errors();
        if($validator->fails()) {
            return array('status' => false, 'errors' => $errors, 'body' => null);
        } else {
            $user = $this->user->userExists($params);
            if ($user) {
                return array('status' => false, 'errors' => $errors, 'body' => null);
            } else {
                $params['password'] = Hash::make($params['password']);
                $user = $this->user->create($params);
                return array('status' => true, 'errors' => null, 'body' => $user);
            }

        }
    }
    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {

    }

    /**
     * @param $params
     * @return mixed
     */
    public function search($params)
    {

    }
}