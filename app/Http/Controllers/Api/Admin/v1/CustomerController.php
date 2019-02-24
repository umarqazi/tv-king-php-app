<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:30 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api\Admin\v1
 */
class CustomerController extends Controller
{
    /**
     * @var
     */
    private $service;

    /**
     * CustomerController constructor.
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }


    /**
     * @param Request $request
     */
    public function index(Request $request){

    }

    /**
     * @param $id
     */
    public function view($id){

    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

    }


}