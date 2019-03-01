<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 4:04 PM
 */

namespace App\Forms;

/**
 * Class BaseListForm
 * @package App\Forms
 */
abstract class BaseListForm extends BaseForm implements IListForm
{
    public $keyword;
    public $sortBy = 'created_at';
    public $sortOrder = 'desc';
    public $itemPerPage = 10;
    public $page = 0;

    /**
     * @return mixed
     */
    public function rules()
    {
       return [];
    }

    /**
     * @param $params
     */
    public function loadFromArray($params){
        foreach ($params as $key => $value){
            if( isset($this->{$key})){
                $this->$key = $value;
            }
        }
    }

    /**
     * @return array|void
     */
    public function toArray()
    {
       return [
           'page' => $this->page,
           'keyword' => $this->keyword
       ];
    }


}