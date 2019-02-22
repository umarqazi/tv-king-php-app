<?php

namespace App\Services;
use App\Forms\BaseListForm;
use App\Forms\IForm;
use App\Forms\IListForm;

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
        // TODO: Implement persist() method.
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