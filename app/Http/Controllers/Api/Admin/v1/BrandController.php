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
use App\Http\Resources\Admin\Brand;
use App\Http\Resources\Admin\BrandCollection;
use App\Services\BrandService;
use App\Services\IUserType;
use Illuminate\Http\Request;

/**
 * Class BrandController
 * @package App\Http\Controllers\Api\Admin\v1
 *
 *
 *
 */
class BrandController extends Controller
{

    /**
     * @var BrandService
     */
    private $brandService;

    public function __construct(BrandService $service)
    {
        $this->brandService = $service;
    }

    /**
     * @param Request $request
     * @return BrandCollection
     */
    public function index(Request $request){
        $form = new SearchForm();
        $form->user_type = IUserType::BRAND;
        $brand = $this->brandService->search($form);
        return new BrandCollection($brand);
    }

    /**
     * @param $id
     * @return Brand
     */
    public function view($id){
     $brand = $this->brandService->findById($id);
     return new Brand($brand);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

    }


}