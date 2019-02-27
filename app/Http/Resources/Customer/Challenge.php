<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\IResource;
use App\Services\ChallengeService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

/**
 * Class Challenge
 * @package App\Http\Resources\Customer
 */
class Challenge extends JsonResource implements IResource
{

    private $challengeService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->challengeService = App::make(ChallengeService::class);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->forList($request);
    }

    /**
     * @param $request
     */
    public function forList($request){
        return [
            'id' => $this->id,
            'title' => $this->title,
            'brand' => $this->brand->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'location' => [
                'latitute' => '',
                'logitude' => ''
            ],
            'created_at' => $this->created_at->format('M/d/Y'),
            'customer_id' => auth()->id(),
            'has_trick' => $this->challengeService->hasTrick(auth()->id(), $this->id),
            'has_winner' => false,
            'trick_count' => $this->tricks->count()
        ];
    }
}
