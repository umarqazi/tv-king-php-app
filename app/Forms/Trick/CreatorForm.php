<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 9:02 PM
 */

namespace App\Forms\Trick;


use App\Forms\BaseForm;

/**
 * Class CreateForm
 * @package App\Forms\Trick
 *
 */
class CreatorForm extends BaseForm
{
    public $customer_id;
    public $challenge_id;
    public $description;


    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'customer_id' => $this->customer_id,
            'challenge_id' => $this->challenge_id,
            'description' => $this->description
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'challenge_id' => 'required'
        ];
    }
}