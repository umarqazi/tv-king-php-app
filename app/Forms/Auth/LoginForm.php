<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 1:17 PM
 */

namespace App\Forms\Auth;


use App\Forms\BaseForm;

/**
 * Class LoginForm
 * @package App\Forms\Auth
 */
class LoginForm extends BaseForm
{
    public $email;
    public $password;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required'
        ];
    }
}