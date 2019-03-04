<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/25/19
 * Time: 7:38 PM
 */

namespace App\Forms\Auth;


use App\Forms\BaseForm;
use Illuminate\Support\Facades\Hash;

class PasswordForm extends BaseForm
{
    /**
     * @var $old_password, $password, $password_confirmation
     */
    public $old_password;
    public $password;
    public $password_confirmation;
    public $user_id;

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
            'password_confirmation' => $this->password_confirmation,
            'user_id' => $this->user_id,
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    $this->checkOldPassword($attribute, $value, $fail);
                },
            ],
            'password' => 'required|min:8|confirmed'
        ];
    }

    /**
     * @param $attribute
     * @param $value
     * @param $fail
     */
    public function checkOldPassword($attribute, $value, $fail){
        $user = auth()->user();
        if (!Hash::check($value, $user->getAuthPassword())){
            $fail('Old password didn\'t match');
        }
    }
}