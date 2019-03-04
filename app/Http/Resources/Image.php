<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Image extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $image = $this->resource;
        /** @var $image \App\Models\Image */
        return [
            'original' => url($image->data['original']),
            'small' => url($image->data['small']),
            'medium' => url($image->data['medium']),
            'large' => url($image->data['large'])
        ];
    }
}
