<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 27/02/2019
 * Time: 6:15 PM
 */

namespace App\Http\Resources;


interface IResource
{

    /**
     * @param $request
     * @return mixed
     */
    public function forList($request);

}