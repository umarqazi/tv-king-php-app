<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\Challenge\CreatorForm;
use App\Forms\IForm;
use App\Forms\IListForm;
use App\Models\Challenge;
use App\Models\TagChallenge;
use Illuminate\Http\Response;
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
     * @return mixed|void
     */
    public function persist(IForm $form)
    {
        /** @var $form CreatorForm */
        $form->validate();
        $entity = new Challenge();
        $entity->name = $form->name;
        $entity->description = $form->description;
        $entity->location = $form->location;
        $entity->brand_id = $form->brand_id;
        $entity->reward = 0;
        $entity->status = 0;
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
     * @return mixed
     */
    public function findById($id)
    {
        return Challenge::with(['brand'])->find($id);
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
     * @param $params
     * @return mixed
     */
    public function search(BaseListForm $form = null)
    {
        $query = Challenge::query();
        $query->with(['brand']);
        return $query->paginate(10);
    }
}