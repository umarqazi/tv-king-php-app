<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Brand\Trick;

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
        /** @var $this \App\Models\Trick */
        return [
            'data' => $this->collection->transform( function(Trick $trick) use ($request){
                return  $trick->forList($request);
            })
        ];
    }
}
