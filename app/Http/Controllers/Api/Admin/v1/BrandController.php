<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:30 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use App\Services\BrandService;
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