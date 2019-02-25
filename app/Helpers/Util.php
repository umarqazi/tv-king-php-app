<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 12:26 PM
 */

namespace App\Helpers;


class Util
{
    /**
     * @param $value
     * @param null $defaultValue
     * @return null
     */
    public static function get($value, $defaultValue = null){
        if(blank($value)){
            return $defaultValue;
        }
        return $value;
    }

}