<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Challenge extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'tricks_count' => 0,
            'last_trick_on' => (new \DateTime())->format("M/d/Y"),
            'published' => $this->published,
        ];
    }
}
