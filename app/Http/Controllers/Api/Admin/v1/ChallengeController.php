<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:31 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Forms\Challenge\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Challenge;
use App\Http\Resources\Admin\ChallengeCollection;
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
     * @return ChallengeCollection
     */
    public function index(Request $request){
        $form = new SearchForm();
        $form->published = true;
        $brand = $this->service->search($form);
        return new ChallengeCollection($brand);
    }

    /**
     * @param $id
     * @return Challenge
     */
    public function view($id){
        $challenge = $this->service->findById($id);
        return new Challenge($challenge);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

    }



}