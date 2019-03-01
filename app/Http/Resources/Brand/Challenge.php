<?php

namespace App\Http\Resources\Brand;

use App\Http\Resources\IResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Challenge extends JsonResource implements IResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $mapped = $this->forList($request);
        return $mapped;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function forList($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'address'       => $this->address,
            'city'          => $this->city,
            'state'         => $this->state,
            'country'       => $this->country,
            'location' => [
                'lat' => $this->location->getLat(),
                'lng' => $this->location->getLng(),
            ],
            'reward'        => $this->reward,
            'reward_notes'  => $this->reward_notes,
            'reward_url'    => $this->reward_url,
            'published'     => $this->published,
            'tags'          => $this->tags,
            'tricks'        => $this->tricks,
            'winner_id'     => $this->winner_id,
            'winner_notes'  => $this->winner_notes,
            'winner_at'     => $this->winner_at,
            'hasWinner'     => $this->hasWinner,
            'trick_count' => $this->tricks->count(),
            'winner' => $this->when($this->hasWinner, (new Trick($this->winner)), [])
        ];
    }
}
