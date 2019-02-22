<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 12:23 PM
 */

namespace App\Forms;


use Illuminate\Contracts\Support\Arrayable;
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
     * @return \Illuminate\Support\MessageBag|mixed
     */
    public function errors(){
        return $this->getValidator()->errors();
    }

    /**
     * @return bool
     */
    public function passes(){
        return $this->getValidator()->passes();
    }

    /**
     * @return bool
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
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getValidator(){
        $validator = Validator::make($this->toArray(), $this->rules(), $this->errorMessages());
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