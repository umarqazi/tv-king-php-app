<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @SWG\Swagger(
     *   basePath="/api",
     *   @SWG\Info(
     *     title="test API",
     *     version="1.0.0"
     *   )
     * )
     */
    public function currentUser(){
        return auth()->user()->getAuthIdentifier();
    }
}
