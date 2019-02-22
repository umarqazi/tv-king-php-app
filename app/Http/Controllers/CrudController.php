<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/12/19
 * Time: 6:29 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


interface CrudController
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);


    /**
     * @param $request
     * @return mixed
     */
    public function edit(Request $request);

    /**
     * @param $request
     * @return mixed
     */
    public function remove(Request $request);

}