<?php

namespace App\Http\Resources\Customer;

use App\Forms\Trick\SearchForm;
use App\Http\Resources\IResource;
use App\Services\ChallengeService;
use App\Services\TrickService;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

/**
 * Class Challenge
 * @package App\Http\Resources\Customer
 */
class Challenge extends JsonResource implements IResource
{

    /**
     * @var ChallengeService
     */
    private $challengeService;
    /**
     * @var TrickService
     */
    private $trickService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->challengeService = App::make(ChallengeService::class);
        $this->trickService = App::make(TrickService::class);
    }

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
     * @return array|mixed
     */
    public function forList($request){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'brand' => $this->brand->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country'       => $this->country,
            'location' => [
                'lat' => $this->location->getLat(),
                'lng' => $this->location->getLng(),
            ],
            'created_at' => $this->created_at->format('M/d/Y'),
            'created_ago' => Carbon::parse($this->created_at)->diffForHumans(),
            'has_trick' => $this->challengeService->hasTrick(auth()->id(), $this->id),
            'has_winner' => $this->hasWinner,
            'trick_count' => $this->tricks->count(),
            'winner' => $this->when($this->hasWinner, (new Trick($this->winner)), [])
        ];
    }
}
