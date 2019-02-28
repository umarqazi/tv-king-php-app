<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:37 PM
 */

namespace App\Services;

/**
 * Class CustomerService
 * @package App\Services
 */
class CustomerService extends UserService
{
    /**
     * CustomerService constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user_type = IUserType::CUSTOMER;
    }

}