<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 1:16 PM
 */

namespace App\Services;


use App\Forms\Auth\LoginForm;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class AuthenticationService
 * @package App\Services
 *
 *
 */
class AuthenticationService
{
    /**
     *
     */
    private $userService;
    private $authticatorManager;

    /**
     * AuthenticationService constructor.
     * @param UserService $userService
     * @param JWTAuth $authManager
     */
    public function __construct(UserService $userService, JWTAuth $authManager)
    {
        $this->userService = $userService;
        $this->authticatorManager = $authManager;
    }

    /**
     * @param LoginForm $form
     * @return string
     * @throws AuthenticationException
     */
    public function asBrand(LoginForm $form){
        $form->validate();
        $account = $this->verifyUser($form->email, $form->password, IUserType::BRAND);
        return $account;
    }

    /**
     * @param LoginForm $form
     * @return User
     * @throws AuthenticationException
     */
    public function asCustomer(LoginForm $form){
        $form->validate();
        $account = $this->verifyUser($form->email, $form->password, IUserType::CUSTOMER);
        return $account;
    }

    /**
     * @param LoginForm $form
     * @return User
     * @throws AuthenticationException
     */
    public function asAdmin(LoginForm $form){
        $form->validate();
        $account = $this->verifyUser($form->email, $form->password, IUserType::ADMIN);
        return $account;
    }

    /**
     * @param $email
     * @param $password
     * @param $user_type
     * @return User
     * @throws AuthenticationException
     */
    private function verifyUser($email, $password, $user_type){
        $user = User::where([
            'email' => $email,
            'user_type' => $user_type
        ])->first();
        /** @var $user User */
        if( blank($user) ){
            throw new AuthenticationException("No Account found");
        }
        $passwordVerified = $user->verifyPassword($password);
        if(!$passwordVerified){
            throw new AuthenticationException("Fail to validate given credentials");
        }
        return $user;
    }
}