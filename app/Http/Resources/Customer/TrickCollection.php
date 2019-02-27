<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TrickCollection extends ResourceCollection
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
            'data' => $this->collection->transform( function(Trick $trick) use ($request){
               return  $trick->forList($request);
            })
        ];
    }
}
