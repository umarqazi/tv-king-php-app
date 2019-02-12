<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 8:41 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;

use App\Http\Requests\ChallengeRequest;
use App\Models\Challenge;
use App\Services\ChallengeService;

class ChallengeController implements CrudController
{
    protected $challenge_service;

    public function __construct(ChallengeService $challengeService)
    {
        $this->challenge_service = $challengeService;
    }

    /**
     * @SWG\Post(
     *   path="/brand/v1/challenge/create",
     *   summary="Create New Challenge",
     *   operationId="store",
     *   produces={"application/json"},
     *   tags={"Challenge"},
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
     *   @SWG\Parameter(
     *     name="status",
     *     in="formData",
     *     description="Challenge Status",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="user_type",
     *     in="formData",
     *     description="User Type",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function create(ChallengeRequest $request){

        /*//kjadhfjasdhasjdklashjkldashd
        $challenge = new Challenge();
        $challenge->brand_id = $_SESSION['user_id'];

        $service->persist($aprams);
        $errors ???*/
    }
}