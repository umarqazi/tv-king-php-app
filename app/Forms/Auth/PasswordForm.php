<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/25/19
 * Time: 7:38 PM
 */

namespace App\Forms\Auth;


use App\Forms\BaseForm;

class PasswordForm extends BaseForm
{
    /**
     * @var $old_password, $password, $password_confirmation
     */
    public $old_password;
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
            'old_password' => $this->old_password,
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
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ];
    }
}