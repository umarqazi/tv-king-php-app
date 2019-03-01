<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 6:33 PM
 */

namespace App\Forms\User;


use App\Forms\BaseForm;

/**
 * Class CreatorForm
 * @package App\Forms\User
 */
class CreatorForm extends BaseForm
{
    public $firstName;
    public $lastName;
    public $email;
    public $user_type;
    public $password;
    public $password_confirmation;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
       return [
           'first_name' => $this->firstName,
           'last_name' => $this->lastName,
           'email' => $this->email,
           'user_type' => $this->user_type,
           'password' => $this->password,
           'password_confirmation' => $this->password_confirmation
       ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'user_type' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }
}