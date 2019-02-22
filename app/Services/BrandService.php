<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 8:50 PM
 */

namespace App\Services;

use App\Forms\BaseListForm;
use App\Forms\IForm;
use App\Forms\IListForm;

class BrandService extends UserService
{

    public function persist(IForm $form)
    {
        /** @var UserCreator $form */
        $form->
        parent::persist($form);
    }
}