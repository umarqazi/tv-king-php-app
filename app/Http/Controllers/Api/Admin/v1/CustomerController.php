<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:30 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Forms\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Customer;
use App\Http\Resources\Admin\CustomerCollection;
use App\Services\CustomerService;
use App\Services\IUserType;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api\Admin\v1
 */
class CustomerController extends Controller
{
    /**
     * @var CustomerService
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
     * @return CustomerCollection
     */
    public function index(Request $request){
        $form = new SearchForm();
        $form->user_type = IUserType::CUSTOMER;
        $brand = $this->service->search($form);
        return new CustomerCollection($brand);
    }

    /**
     * @param $id
     * @return Customer
     */
    public function view($id){
        $customer = $this->service->findById($id);
        return new Customer($customer);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

    }


}