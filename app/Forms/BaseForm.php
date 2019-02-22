<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 12:23 PM
 */

namespace App\Forms;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Concerns\ValidatesAttributes;

/**
 * Class BaseValidator
 * @package App\Validators
 *
 */
abstract class BaseForm implements IForm
{
    /**
     * @return mixed|void
     */
    public function errors(){
        return $this->getValidator()->errors();
    }

    /**
     *
     */
    public function passes(){
        return $this->getValidator()->passes();
    }

    /**
     *
     */
    public function fails(){
        return $this->getValidator()->fails();
    }

    /**
     * @return array|mixed
     */
    public function errorMessages()
    {
        return [];
    }

    /**
     * @return \Illuminate\Support\Facades\Validator
     */
    private function getValidator(){
        $validator = Validator::make($this->getParams(), $this->rules(), $this->errorMessages());
        return $validator;
    }

    /**
     * @return mixed|void
     */
    public function validate()
    {
        $this->getValidator()->validate();
    }

}