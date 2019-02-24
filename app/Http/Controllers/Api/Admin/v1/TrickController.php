<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:31 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use App\Services\TrickService;
use Illuminate\Http\Request;

/**
 * Class TrickController
 * @package App\Http\Controllers\Api\Admin\v1
 *
 *
 *
 */
class TrickController extends Controller
{

    private $trickService;

    /**
     * TrickController constructor.
     * @param TrickService $service
     */
    public function __construct(TrickService $service)
    {
        $this->trickService = $service;
    }

    /**
     * @param Request $request
     */
    public function index($challenge_id, Request $request){


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