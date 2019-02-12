<?php

namespace App\Http\Controllers\Api\Brand\v1;

use App\Http\Requests\UserSignup;
use App\Services\SignupService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SignupController
 * @package App\Http\Controllers\Api\Brand\v1
 *
 * api/brand/v1/signup
 */
class SignupController extends Controller
{

    public function signup($request){
        //validate...

        $service = new SignupService();
        $user = $service->asBrand($request);

    }


}
