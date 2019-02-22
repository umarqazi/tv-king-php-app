<?php

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IListForm;
use App\Forms\Tag\TagSearchForm;
use App\Models\Tag;
use App\Forms\IForm;
use App\Forms\Tag\CreatorForm;

/**
 * Class TagService
 * @package App\Services
 * @author Umar Farooq
 */
class TagService extends BaseService {

    /**
     * @param CreatorForm $params
     * @return \App\Models\Tag
     */
    public function persist(IForm $form)
    {
        $form->validate();

        $model = new Tag();
        $model->name = $form->name;
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
     * @param BaseListForm|null $form
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(BaseListForm $form = null)
    {
        if($form == null){
            $form = new TagSearchForm();
        }
        $query = Tag::query();
        if(!empty($form->keyword)){
            $query->where('name', 'LIKE', '%'.$form->keyword.'%');
        }
        return $query->paginate( 40 );
    }
}