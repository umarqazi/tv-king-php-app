<?php

namespace App\Services;
use App\Forms\BaseListForm;
use App\Forms\IForm;
use App\Forms\IListForm;
use App\Forms\Trick\CreatorForm;
use App\Forms\Trick\SearchForm;
use App\Models\Trick;

/**
 * Class TrickService
 * @package App\Services
 * @author Umar Farooq
 */
class TrickService extends BaseService {

    /**
     * @param IForm $form
     * @return Trick|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function persist(IForm $form)
    {
        $form->validate();
        /** @var $form CreatorForm */
        $entity = new Trick();
        $entity->customer_id = $form->customer_id;
        $entity->challenge_id = $form->challenge_id;
        $entity->description = $form->description;
        $entity->save();
        return $entity;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Trick::query()->find($id);
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
     * @param BaseListForm|null $form
     * @return \Illuminate\Pagination\LengthAwarePaginator|void
     */
    public function search(BaseListForm $form = null)
    {
        /** @var SearchForm $form */
        $query = Trick::query()->with(['customer']);
        $query->when($form->challenge_id, function($query, $challenge_id){
            $query->where(['challenge_id' => $challenge_id]);
        });
        $query->when($form->customer_id, function($query, $customer_id){
            $query->where(['customer_id' => $customer_id]);
        });
        return $query->orderBy($form->sortBy, $form->sortOrder)->paginate($form->itemPerPage);
    }
}