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
    public $page;
    public $keyword;

    /**
     * @return mixed
     */
    public function rules()
    {
       return [];
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