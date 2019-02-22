<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 9:48 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Http\Controllers\Controller;
use App\Services\TrickService;
use Illuminate\Http\Request;

class TrickController extends Controller
{
    /**
     * @var TrickService
     */
    private $trickService;

    public function __construct(TrickService $service)
    {
        $this->trickService = $service;
    }

    /**
     * @param Request $request
     */
    public function index(Request $request){

    }


}