<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 9:40 PM
 */

namespace App\Services;

use App\Forms\BaseListForm;
use App\Http\Requests\UserSignup;
use \App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class SignupService
{
    /**
     * @var User
     */
    protected $user;
    protected $auth;
    protected $userParams = array();

    /**
     * SignupService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->auth = $auth;
    }

    public function asAdmin($params){

    }

    public function asBrand($params){

    }

    public function asCustomer($params){

    }

}