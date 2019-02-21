<?php

namespace App\Services;

use App\Models\Challenge;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class ChallengeService
 * @package App\Services
 * @author Umar Farooq
 */
class ChallengeService extends BaseService {

    protected $challenge;
    protected $params;

    public function __construct(Challenge $challenge)
    {
        $this->challenge  = $challenge;
    }

    public function setParams($params){
        $this->params['name']           = $params['name'];
        $this->params['description']    = $params['description'];
        $this->params['location']       = $params['location'];
        $this->params['reward']         = $params['reward'];
        $this->params['status']         = 1;
        $this->params['user_id']        = Auth::user()->id;
        $response = $this->persist($this->params);
        return $response;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function persist($params)
    {
        $rules = [
            'name'          => 'required|max:191',
            'description'   => 'required|max:191',
            'location'      => 'required|max:191',
            'reward'        => 'required|integer',
            'status'        => 'required|integer',
            'user_id'       => 'required|integer',
        ];

//        return $this->validateRequest($params, $rules);

        $response = $this->validateRequest($params, $rules);

        if (!$response['status']){
            return response([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'Invalid Data!',
                'body' => $params,
                'errors' => $response['errors'],
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $user = Auth::user();
            if($user['user_type'] == 2){
                $challenge = $this->challenge->create($params);

                /*Response for Successful User Creation*/
                return response([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Challenge Has been Created Successfully!',
                    'body' => $user,
                    'errors' => null,
                ],Response::HTTP_OK);
            } else{
                return response([
                    'http-status' => Response::HTTP_UNAUTHORIZED,
                    'status' => false,
                    'message' => 'You are Unauthorized to create Challenge!',
                    'body' => null,
                    'errors' => null,
                ],Response::HTTP_UNAUTHORIZED);
            }
        }
    }

    public function validateRequest($params, $rules)
    {
        $validator = Validator::make($params, $rules);

        $errors = $validator->errors();

        if($validator->fails()){
            return array('status' => false, 'errors' => $errors);
        } else{
            return array('status' => true, 'errors' => null);
        }
    }

    public function update_name($params){

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {

    }

    /**
     * @param $params
     * @return mixed
     */
    public function search($params)
    {

    }
}