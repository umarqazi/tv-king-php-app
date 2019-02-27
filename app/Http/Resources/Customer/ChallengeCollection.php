<?php

namespace App\Http\Resources\Customer;

use App\Services\AuthenticationService;
use App\Services\ChallengeService;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\App;

class ChallengeCollection extends ResourceCollection
{
    /**
     * @var ChallengeService
     */
    private $challengeService;

    /**cr
     * ChallengeCollection constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->challengeService = App::make(ChallengeService::class);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform( function(Challenge $challenge) use ($request){
                return $challenge->forList($request);
            })
        ];
    }
}
