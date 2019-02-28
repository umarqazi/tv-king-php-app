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
    public $address;
    public $city;
    public $state;
    public $country;
    public $latitude;
    public $longitude;
    public $tags;

    public $reward;
    public $reward_notes;
    public $reward_url;

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'brand_id' => 'required|integer',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
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
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'tags' => $this->tags
        ];
    }
}