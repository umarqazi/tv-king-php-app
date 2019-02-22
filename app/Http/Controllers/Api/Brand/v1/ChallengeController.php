<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 8:41 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;

use App\Forms\Challenge\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;
use App\Models\Challenge;
use App\Services\ChallengeService;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * @var ChallengeService
     */
    protected $challengeService;

    /**
     * ChallengeController constructor.
     * @param ChallengeService $challengeService
     */
    public function __construct(ChallengeService $challengeService)
    {
        $this->challengeService = $challengeService;
    }

    /**
     * @SWG\Post(
     *   path="/brand/v1/challenge/create",
     *   summary="Create New Challenge",
     *   operationId="store",
     *   produces={"application/json"},
     *   tags={"Challenge"},
     *   @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     description="Auth Token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Challenge Name",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="formData",
     *     description="Challenge Description",
     *     required=true,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="location",
     *     in="formData",
     *     description="Challenge Location",
     *     required=true,
     *     type="string"
     *   ),
     *    @SWG\Parameter(
     *     name="reward",
     *     in="formData",
     *     description="Challenge Reward",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function store(Request $request){
        $form = new ChallengeCreatorForm();
        $response =$this->challengeService->persist();
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function view($id){
        return $this->challengeService->findById($id);
    }


    public function index(Request $request){
        $form = new SearchForm();
        return $this->challengeService->search( $form );
    }
}