<?php

namespace App\Services;

use App\Forms\IListForm;
use App\Models\Tag;
use App\Forms\IForm;
use App\Forms\Tag\TagCreatorForm;

/**
 * Class TagService
 * @package App\Services
 * @author Umar Farooq
 */
class TagService extends BaseService {

    /**
     * @param TagCreatorForm $params
     * @return \App\Models\Tag
     */
    public function persist(IForm $params)
    {
        $params->validate();

        $model = new Tag();
        $model->name = $params->name;
        $model->save();
        return $model;
    }

    /**
     * @param $id
     * @return \App\Models\Tag
     */
    public function findById($id)
    {
        return Tag::findOrFail($id);
    }

    /**
     * @param $name
     */
    public function findByName($name)
    {

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
    public function search(IListForm $params = null)
    {
        return Tag::all();
    }
}