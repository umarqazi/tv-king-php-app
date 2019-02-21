<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/12/19
 * Time: 6:29 PM
 */

namespace App\Http\Controllers;


interface CrudController
{

    public function create($request);


    public function edit($request);

    public function remove($request);

}