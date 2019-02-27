<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 27/02/2019
 * Time: 8:32 PM
 */

namespace App\Http\Resources\Customer;

use App\Http\Resources\Image;
use Illuminate\Http\Resources\Json\JsonResource;


class Profile extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'profile' => new Image($this->profileImage)
        ];
    }

}