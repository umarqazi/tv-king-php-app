<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 2:04 PM
 */

namespace App\Forms;


use Illuminate\Validation\ValidationException;

interface IForm
{
    /**
     * @return mixed
     */
    public function rules();

    /**
     * @return bool
     */
    public function passes();

    /**
     * @return boolean
     */
    public function fails();

    /**
     * @return mixed
     * @throws ValidationException
     */
    public function validate();

    /**
     * @return mixed
     */
    public function getParams();

    /**
     *
     * @return mixed
     */
    public function errorMessages();

    /**
     * @return mixed
     */
    public function errors();
}