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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

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
        $this->userParams['password'] = $params['password'];
        $this->userParams['password_confirmation'] = $params['password_confirmation'];

        $this->userParams['user_type'] = 2;
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

    /*public function persist2(UserSignup $request){
        return $this->validateRequest($request->all(), $request->rules());
    }*/

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

        $response = $this->validateRequest($params, $rules);

        if (!$response['status']){

            /*Set Password Params to null*/
            $params['password'] = null;
            $params['password_confirmation'] = null;

            /*Send Response if Validation Fails*/
            return response([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'Invalid Data!',
                'body' => $params,
                'errors' => $response['errors'],
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {

            /*Check if User Exists with same Role and Email*/
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
                    'status' => true,
                    'message' => 'User Has been Created Successfully!',
                    'body' => $user,
                    'errors' => null,
                ],Response::HTTP_OK);
            }
        }
    }

    /**
     * @param $params
     * @param $rules
     * @return array
     */
    public function validateRequest($params, $rules){
        $validator = Validator::make($params, $rules);

        $errors = $validator->errors();

        if($validator->fails()){
            return array('status' => false, 'errors' => $errors);
        } else{
            return array('status' => true, 'errors' => null);
        }
    }

    public function loginAsAdmin($params){
        $this->userParams['email']      = $params['email'];
        $this->userParams['password']   = $params['password'];
        $this->userParams['user_type']  = 1;
        $response = $this->login($this->userParams);
        return $response;
    }

    public function loginAsBrand($params){
        $this->userParams['email']      = $params['email'];
        $this->userParams['password']   = $params['password'];
        $this->userParams['user_type']  = 2;
        $response = $this->login($this->userParams);
        return $response;
    }

    public function loginAsCustomer($params){
        $this->userParams['email']      = $params['email'];
        $this->userParams['password']   = $params['password'];
        $this->userParams['user_type']  = 3;
        $response =  $this->login($this->userParams);
        return $response;
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
            'user_type' => 'required'
        ];

        $response = $this->validateRequest($params, $rules);

        /*Set Password to null*/
        if (!$response['status']){
            $params['password'] = null;
            /*Send Response if Validation Fails*/
            return response()->json([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'Invalid Data!',
                'body' => $params,
                'errors' => $response['errors'],
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $credentials = [
                'email'         => $params['email'],
                'password'      => $params['password'],
                'user_type'     => $params['user_type'],
            ];

            $token = auth()->attempt($credentials);

            if (!$token ) {
                $params['password'] = null;

                /*Send Response if Login Fails*/
                return response()->json([
                    'http-status' => Response::HTTP_UNAUTHORIZED,
                    'status' => false,
                    'message' => 'We cant find an account with these credentials.',
                    'body' => $params
                ],Response::HTTP_UNAUTHORIZED);
            }else{
                $response_token = $this->respondWithToken($token);

                /*Send Response for Successful Login*/
                return response()->json ([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'User Successfully Logged In!',
                    'body' => $token,
                    'errors' =>null
                ],Response::HTTP_OK);
            }
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
        if (JWTAuth::authenticate()){
            auth()->logout();

            /*Send Response for Successful Logout*/
            return response()->json([
                'http-status' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Successfully logged out',
                'body' => null
            ],Response::HTTP_OK);
        } else {
            /*Send Response if User is Unauthorized*/
            return response()->json([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'User Unauthorized!',
                'body' => null
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function passwordReset($params)
    {
        $rules = [
            'prev_password'     => 'required',
            'password'          => 'required|min:8|confirmed',
        ];

        $response = $this->validateRequest($params, $rules);

        if (!$response['status']){
            /*Set Password Params to null*/
            $params['prev_password'] = null;
            $params['password'] = null;
            $params['password_confirmation'] = null;

            /*Send Response if Validation Fails*/
            return response([
                'http-status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => false,
                'message' => 'Invalid Data!',
                'body' => $params,
                'errors' => $response['errors'],
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $user = JWTAuth::authenticate();

            if (!Hash::check($params['prev_password'], $user['password'])) {
                /*Send Response if Previous Password didn't Match*/
                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => false,
                    'message' => 'Your provided password didn\'t match.',
                    'body' => null
                ], Response::HTTP_OK);
            } else {
                // all good so Reset User's Password
                $user = $this->updatePassword($params);

                return response()->json([
                    'http-status' => Response::HTTP_OK,
                    'status' => true,
                    'message' => 'Password has been Successfully Updated!',
                    'body' => $user,
                ], Response::HTTP_OK);
            }
        }
    }

    public function updatePassword($params){
        $user = auth()->user();
        $this->user->where('id', $user->id)->update(array('password' => Hash::make($params['password'])));
        return $user;
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