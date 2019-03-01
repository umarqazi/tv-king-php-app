<?php

namespace App\Http\Resources\Brand;

use App\Forms\Trick\SearchForm;
use App\Http\Resources\IResource;
use App\Services\TrickService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

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
        $service = App::make(TrickService::class);
        $form = new SearchForm();
        $form->challenge_id = $this->id;
        $mapped = $this->forList($request);

        $tricks = new TrickCollection($service->search($form));
        $mapped['tricks'] = $tricks;
        return $mapped;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function forList($request)
    {
        $mapper = new \App\Http\Resources\Customer\Challenge( $this );
        return $mapper->forList($request);
    }
}
