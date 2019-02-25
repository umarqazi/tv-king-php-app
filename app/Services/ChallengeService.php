<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\Challenge\CreatorForm;
use App\Forms\Challenge\SearchForm;
use App\Forms\IForm;
use App\Forms\IListForm;
use App\Helpers\Util;
use App\Models\Challenge;
use App\Models\TagChallenge;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class ChallengeService
 * @package App\Services
 * @author Umar Farooq
 */
class ChallengeService extends BaseService{

    /**
     * @param IForm $form
     * @return Challenge|mixed
     */
    public function persist(IForm $form)
    {
        /** @var $form CreatorForm */
        $form->validate();
        $entity = new Challenge();
        $entity->brand_id = $form->brand_id;
        $entity->name = $form->name;
        $entity->description = $form->description;
        $entity->address = $form->address;
        $entity->city = $form->city;
        $entity->state = $form->state;
        $entity->country = $form->country;
        $entity->location = DB::raw('NULL');

        $entity->reward = Util::get($form->reward, '');
        $entity->reward_notes = Util::get($form->reward_notes, '');
        $entity->reward_url = $form->reward_url;
        $entity->save();

        $this->attachTags($entity, (array)$form->tags);
        return $entity;
    }

    /**
     * @param Challenge $challenge
     * @param array $tags
     */
    private function attachTags($challenge, $tags){
        foreach ((array)$tags as $idx => $tag_id){
            $tagChallenge = new TagChallenge();
            $tagChallenge->challenge_id = $challenge->id;
            $tagChallenge->tag_id = $tag_id;
            $tagChallenge->save();
        }
    }


    /**
     * @param $id
     * @return Challenge
     */
    public function findById($id)
    {
        return Challenge::with(['brand', 'tags'])->find($id);
        $query = Challenge::query();
        $query->with(['brand']);
        $challenge = $query->find($id);
        return $challenge;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        // TODO: Implement remove() method.
    }

    /**
     * @param BaseListForm $form
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form)
    {
        /** @var SearchForm $form */
        $query = Challenge::query();
        $query->with(['brand']);
        if(!empty($form->brand_id)){
            $query->where('brand_id', '=', $form->brand_id);
        }
        return $query->paginate(10);
    }
}