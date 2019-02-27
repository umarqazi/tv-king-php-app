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
        'id', 'title'
       ];
    }
}
