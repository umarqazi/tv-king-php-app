<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/26/19
 * Time: 11:40 AM
 */

namespace App\Forms\Auth;

use App\Forms\BaseForm;

/**
 * Class ProfileImageForm
 * @package App\Forms\Auth
 *
 */
class ProfileImageForm extends BaseForm
{
    public $profile;
    public $user_id;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return[
            'profile' => $this->profile,
            'user_id' => $this->user_id
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
          'profile' => 'image|required|mimes:jpeg,png,jpg,gif',
          'user_id' => 'required'
        ];
    }
}