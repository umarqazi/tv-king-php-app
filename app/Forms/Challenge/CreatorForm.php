<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 5:19 PM
 */

namespace App\Forms\Challenge;

use App\Forms\BaseForm;

/**
 * Class ChallengeCreatorForm
 * @package App\Forms\Challenge
 */
class CreatorForm extends BaseForm
{
    public $name;
    public $description;
    public $brand_id;

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'safe',
            'brand_id' => 'required|integer'
        ];
    }


    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}