<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 7:39 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Http\Controllers\Controller;
use App\Http\Resources\Profile;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\Brand\v1
 *
 *
 */
class ProfileController extends Controller
{
    private $userService;

    /**
     * ProfileController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index(Request $request){
        $user = $this->userService->findById(  $this->currentUser() );
        return new Profile( $user );
    }

    /**
     * @param Request $request
     */
    public function password(Request $request){

    }

    /**
     * @param Request $request
     */
    public function image(Request $request){

    }

    /**
     * @param Request $request
     */
    public function personal(Request $request){

    }
}