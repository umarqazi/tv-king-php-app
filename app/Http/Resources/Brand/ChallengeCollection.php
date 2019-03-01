<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChallengeCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function(Challenge $challenge) use ($request){
                return $challenge->forList($request);
            })
        ];
    }
}
