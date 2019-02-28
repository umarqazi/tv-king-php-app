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
            'data' => $this->collection->transform(function(Challenge $challenge){
                return [
                    'id' => $challenge->id,
                    'name' => $challenge->name,
                    'address' => $challenge->address,
                    'city' => $challenge->city,
                    'state' => $challenge->state,
                    'country' => $challenge->country,
                    'location' => [
                        'lat' => $challenge->location->getLat(),
                        'lng' => $challenge->location->getLng(),
                    ],
                    'reward' => $challenge->reward,
                    'reward_notes' => $challenge->reward_notes,
                    'reward_url' => $challenge->reward_url,
                    'published' => $challenge->published,
                    'trick_count' => $challenge->tricks->count(),
                    'has_winner' => false
                ];
            })
        ];
        return parent::toArray($request);
    }
}
