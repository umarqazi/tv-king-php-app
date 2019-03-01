<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\IResource;
use App\Http\Resources\Customer\Profile;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class Trick
 * @package App\Http\Resources\Customer
 */
class Trick extends JsonResource implements IResource
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
        /** @var $this \App\Models\Trick */
        return[
            'id' => $this->id,
            'description' => $this->description,
            'challenge_id' => $this->challenge_id,
            'performed_by' => new Profile($this->customer),
            'created_at' => $this->created_at->format("M/d/Y"),
            'time_ago' => Carbon::parse($this->created_at)->diffForHumans(),
            'is_winner' => ($this->challenge->winner_id == $this->id)
        ];
    }
}
