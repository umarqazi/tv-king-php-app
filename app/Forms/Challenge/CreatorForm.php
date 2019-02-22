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
    public $location;
    public $latitude;
    public $longitude;
    public $tags;

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'name' => 'required',
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
        return [
            'name' => $this->name,
            'description' => $this->description,
            'brand_id'=> $this->brand_id,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'tags' => $this->tags
        ];
    }
}