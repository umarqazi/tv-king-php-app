<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/26/19
 * Time: 11:40 AM
 */

namespace App\Forms\Auth;


use App\Forms\BaseForm;

class ProfileImageForm extends BaseForm
{
    public $profile;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return[
            'profile' => $this->profile
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
          'profile' => 'required'
        ];
    }
}