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

    /**
     * @return mixed
     */
    public function rules()
    {
        // TODO: Implement rules() method.
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return [];
    }
}