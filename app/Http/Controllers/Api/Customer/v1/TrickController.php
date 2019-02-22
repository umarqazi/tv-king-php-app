<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 9:35 PM
 */

namespace App\Http\Controllers\Api\Customer\v1;


use App\Http\Controllers\Controller;
use App\Services\TrickService;

/**
 * Class TrickController
 * @package App\Http\Controllers\Api\Customer\v1
 */
class TrickController extends Controller
{
    protected $trickService;

    /**
     * TrickController constructor.
     * @param TrickService $service
     */
    public function __construct(TrickService $service)
    {
        $this->trickService = $service;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function view($id){
        return $this->trickService->findById($id);
    }

    /**
     * @param $callenge_id
     */
    public function store($callenge_id){

    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator|void
     */
    public function index(){
        return $this->trickService->search( null );
    }
}