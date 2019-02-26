<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/25/19
 * Time: 8:01 PM
 */

namespace App\Services;
use App\Forms\Auth\PasswordForm;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class ProfileService
{
    /**
     * @var User
     */
    private $user;

    /**
     * ProfileService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param PasswordForm $form
     * @return User|\Exception|AuthenticationException|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function asBrand(PasswordForm $form){
        $form->validate();
        try{
            $user = $this->verifyPassword($form->old_password);
            $this->user->where('id', $user['id'])->update(['password' => Hash::make($form->password)]);
            return $user;
        } catch (AuthenticationException $e){
            return $e;
        }
    }

    /**
     * @param PasswordForm $form
     * @return User|\Exception|AuthenticationException|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function asCustomer(PasswordForm $form){
        $form->validate();
        try{
            $user = $this->verifyPassword($form->old_password);
            $this->user->where('id', $user['id'])->update(['password' => Hash::make($form->password)]);
            return $user;
        } catch (AuthenticationException $e){
            return $e;
        }
    }

    /**
     * @param PasswordForm $form
     * @return User|\Exception|AuthenticationException|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function asAdmin(PasswordForm $form){
        $form->validate();
        try{
            $user = $this->verifyPassword($form->old_password);
            $this->user->where('id', $user['id'])->update(['password' => Hash::make($form->password)]);
            return $user;
        } catch (AuthenticationException $e){
            return $e;
        }
    }

    /**
     * @param $password
     * @return User|\Illuminate\Contracts\Auth\Authenticatable|null
     * @throws AuthenticationException
     */
    private function verifyPassword($password){
        $user = auth()->user();
        /** @var $user User */
        $passwordVerified = $user->verifyPassword($password);
        if(!$passwordVerified){
            throw new AuthenticationException("Your Password didn't match");
        }
        return $user;
    }
}