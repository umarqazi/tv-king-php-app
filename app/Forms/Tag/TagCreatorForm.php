<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 12:32 PM
 */

namespace App\Forms\Tag;

use App\Forms\BaseForm;

/**
 * Class TagCreator
 * @package App\Validators\Tag
 */
class TagCreatorForm extends BaseForm
{
    public $name;

    /**
     * @return array
     */
    public function rules()
    {
       return [
            'name' => 'required'
       ];
    }

    /**
     * @return array|mixed
     */
    public function getParams()
    {
        return [
            'name' => $this->name
        ];
    }
}