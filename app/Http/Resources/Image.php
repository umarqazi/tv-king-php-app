<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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
        if(blank($this->resource)){
            return null;
        }
        $profileDisk = Storage::disk('profile_images');
        $image = $this->resource->data;
        /** @var $image \App\Models\Image */
        $original = Arr::get($image, 'original', null);
        $small = Arr::get($image, 'small', null);
        $medium = Arr::get($image, 'medium', null);
        $large = Arr::get($image, 'large', null);
        if(blank($original)){
            return null;
        }
        return [
            'original' => $profileDisk->url($original),
            'small' => $profileDisk->url($small),
            'medium' => $profileDisk->url($medium),
            'large' => $profileDisk->url($large),
        ];
    }
}
