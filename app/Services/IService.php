<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IListForm;
use App\Http\Requests\UserSignup;
use App\Forms\IForm;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IService
 * @package App\Services
 *
 */
interface IService{

    /**
     * @param IForm $form
     * @return mixed
     */
    public function persist(IForm $form);

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id);

    /**
     * @param IListForm $form
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form);
}