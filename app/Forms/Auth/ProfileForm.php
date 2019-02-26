<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/26/19
 * Time: 6:00 PM
 */

namespace App\Forms\Auth;


use App\Forms\BaseForm;

class ProfileForm extends BaseForm
{
    public $first_name;
    public $last_name;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return[
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name'  => 'required'
        ];
    }
}