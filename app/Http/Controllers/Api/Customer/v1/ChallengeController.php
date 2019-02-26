<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 5:14 PM
 */

namespace App\Http\Controllers\Api\Customer\v1;

use App\Forms\Challenge\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Services\ChallengeService;

/**
 * Class ChallengesController
 * @package App\Http\Controllers\Api\Customer\v1
 */
class ChallengeController extends Controller
{
    /**
     * @var ChallengeService
     */
    private $challengeService;


    public function __construct(ChallengeService $service)
    {
        $this->challengeService = $service;
    }

    public function index(){
        $form = new SearchForm();
        return $this->challengeService->search($form);
    }

    public function view($id){
        $challenge = $this->challengeService->findById($id);
        return $challenge;
    }

    /**
     * @param $challenge_id
     */
    public function tricks($challenge_id){

    }
}