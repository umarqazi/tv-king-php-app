<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 9:48 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Forms\Challenge\WinnerForm;
use App\Forms\Trick\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\TrickCollection;
use App\Services\ChallengeService;
use App\Services\TrickService;
use Illuminate\Http\Request;

class TrickController extends Controller
{
    /**
     * @var TrickService
     */
    private $trickService;
    private $challengeService;

    public function __construct(TrickService $service, ChallengeService $challengeService)
    {
        $this->trickService = $service;
        $this->challengeService = $challengeService;
    }

    /**
     * @param Request $request
     */
    public function index(Request $request, $challange_id){
        $form = new SearchForm();
        $form->challenge_id = $challange_id;
        $tricks = $this->trickService->search($form);
        return new TrickCollection($tricks);
    }

    public function winner(Request $request, $id){
        $form = new WinnerForm();
        $form->challenge_id = $id;
        $form->trick_id = $request['trick_id'];
        $form->notes = $request['notes'];
        $challenge = $this->challengeService->winner($form);
        return $challenge;
    }
}