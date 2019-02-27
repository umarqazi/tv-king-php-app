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
        return [
            'original' => url($this->storage_path).'/'.$this->name,
            'small' => url($this->storage_path).'/small/'.$this->name,
            'medium' => url($this->storage_path).'/medium/'.$this->name,
            'large' => url($this->storage_path).'/large/'.$this->name
        ];
        //return parent::toArray($request);
    }
}
