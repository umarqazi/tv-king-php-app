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
use App\Http\Resources\Customer\Challenge;
use App\Http\Resources\Customer\ChallengeCollection;
use App\Http\Resources\Customer\TrickCollection;
use App\Services\ChallengeService;
use App\Services\TrickService;

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

    /**
     * @var TrickService
     */
    private $trickService;

    public function __construct(ChallengeService $service, TrickService $trickService)
    {
        $this->challengeService = $service;
        $this->trickService = $trickService;
    }

    /**
     * @return ChallengeCollection
     */
    public function index(){
        $form = new SearchForm();
        $form->sortOrder = 'DESC';
        $form->sortBy = 'published_at';
        $form->published = true;
        $result = $this->challengeService->search($form);
        return new ChallengeCollection($result);
    }

    /**
     * @param $id
     * @return Challenge
     */
    public function view($id){
        $challenge = $this->challengeService->findById($id);
        return new Challenge($challenge);
    }

    /**
     * @param $challenge_id
     */
    public function tricks($challenge_id){
        $form = new \App\Forms\Trick\SearchForm();
        $form->challenge_id = $challenge_id;
        $tricks = $this->trickService->search($form);
        return new TrickCollection($tricks);
    }
}