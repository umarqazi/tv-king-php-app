<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/11/19
 * Time: 9:40 PM
 */

namespace App\Services;

use App\Http\Requests\UserSignup;
use \App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

class SignupService extends BaseService
{
    /**
     * @var User
     */
    protected $user;
    protected $auth;
    protected $userParams = array();

    /**
     * SignupService constructor.
     * @param User $user
     */
    public function __construct(User $user, JWTAuth $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
    }

    public function asAdmin($params){
        $this->userParams['name'] = $params['name'];
        $this->userParams['email'] = $params['email'];
        $this->userParams['user_type'] = 1;
        $this->userParams['password'] = $params['password'];
        $this->userParams['password_confirmation'] = $params['password_confirmation'];
        $response = $this->persist($this->userParams);
        return $response;
    }

    public function asBrand($params){
        $this->userParams['name'] = $params['name'];
        $this->userParams['email'] = $params['email'];
        $this->userParams['user_type'] = 2;
        $this->userParams['password'] = $params['password'];
        $this->userParams['password_confirmation'] = $params['password_confirmation'];
        $response = $this->persist($this->userParams);
        return $response;
    }

    public function asCustomer($params){
        $this->userParams['name'] = $params['name'];
        $this->userParams['email'] = $params['email'];
        $this->userParams['user_type'] = 3;
        $this->userParams['password'] = $params['password'];
        $this->userParams['password_confirmation'] = $params['password_confirmation'];
        $response = $this->persist($this->userParams);
        return $response;
    }

    public function persist2(UserSignup $request){
        return $this->validateRequest($request->all(), $request->rules());
    }

    /**
     * @param $params
     * @return mixed
     */
    public function persist($params)
    {
        $rules = [
            'name'      => 'required|max:191',
            'email'     => 'required|email|max:191',
            'user_type' => 'required|integer',
            'password'  => 'required|min:8|confirmed',
        ];

        return $this->validateRequest($params, $rules);
    }

    public function validateRequest($params, $rules){
        $validator = Validator::make($params, $rules);

        $errors = $validator->errors();

        /*Set Password Params to null*/
        $params['password'] = null;
        $params['password_confirmation'] = null;

        if($validator->fails()){
            /*Response for Failed Validation*/
            return response([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'Invalid Details!',
                'body' => $params,
                'errors' => $errors,
            ],Response::HTTP_UNPROCESSABLE_ENTITY);

        } else {
            $user = $this->user->userExists($params);
            if ($user) {
                /*Response for Already existing User*/
                return response([
                    'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'status' => false,
                    'message' => 'A user Already exists with this email and type!',
                    'body' => $params,
                    'errors' => null,
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $params['password'] = Hash::make($params['password']);
                $user = $this->user->create($params);

                /*Response for Successful User Creation*/
                return response([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'User Has been Created Successfully!',
                    'body' => $user,
                    'errors' => null,
                ],Response::HTTP_OK);
            }
        }
    }

    /**
     * @param $params
     * @return mixed
     */
    public function login($params)
    {
        $rules = [
            'email'     => 'required|email|max:191',
            'password'  => 'required',
        ];

        $validator = Validator::make($params, $rules);
        $errors = $validator->errors();

        $params['password'] = null;
        if ($validator->fails()){
            return response()->json([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'Invalid Data!',
                'body' => $params,
                'errors' => $errors,
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $credentials = [
                'email' => $params['email'],
                'password' => $params['password']
            ];

            if (! $token = $this->auth->attempt($credentials)) {
                $params['password'] = null;
                return response()->json([
                    'http-status' => Response::HTTP_UNAUTHORIZED,
                    'status' => false,
                    'message' => 'We cant find an account with these credentials.',
                    'body' => $params
                ],Response::HTTP_UNAUTHORIZED);
            }

            $response_token = $this->respondWithToken($token);
            return response()->json ([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'User Successfully Logged In!',
                'body' => $token,
                'errors' =>null
            ],Response::HTTP_OK);
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout($params)
    {
        if ($this->auth->authenticate()){
            auth()->logout();
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Successfully logged out',
                'body' => null
            ],Response::HTTP_OK);
        } else {
            return response()->json([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'User Unauthorized!',
                'body' => null
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
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