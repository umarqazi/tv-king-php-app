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
use App\Models\User;

class BrandService extends UserService
{

    /**
     * BrandService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user_type = IUserType::BRAND;
    }
}