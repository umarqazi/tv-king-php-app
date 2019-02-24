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

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
       return [
           'firstName' => $this->firstName,
           'lastName' => $this->lastName,
           'email' => $this->email
       ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
        ];
    }
}