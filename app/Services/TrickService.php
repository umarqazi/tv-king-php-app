<?php

namespace App\Services;
use App\Forms\BaseListForm;
use App\Forms\IForm;
use App\Forms\IListForm;
use App\Forms\Trick\CreatorForm;
use App\Models\Trick;

/**
 * Class TrickService
 * @package App\Services
 * @author Umar Farooq
 */
class TrickService extends BaseService {

    /**
     * @param $params
     * @return mixed
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
        // TODO: Implement findById() method.
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
        // TODO: Implement search() method.
    }
}