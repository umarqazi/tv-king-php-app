<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 28/02/2019
 * Time: 2:38 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ErrorController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function noRouteFound(Request $request){
        return response()->json(['message' => 'Route Not Found.', 'route' => $request->getRequestUri()], 404);
    }

}