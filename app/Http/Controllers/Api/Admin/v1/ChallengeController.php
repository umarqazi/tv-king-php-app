<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:31 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use App\Services\ChallengeService;
use Illuminate\Http\Request;

/**
 * Class ChallengeController
 * @package App\Http\Controllers\Api\Admin\v1
 *
 *
 */
class ChallengeController extends Controller
{
    /**
     * @var ChallengeService
     */
    private $service;

    /**
     * ChallengeController constructor.
     */
    public function __construct(ChallengeService $service)
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