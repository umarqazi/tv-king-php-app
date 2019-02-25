<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/25/19
 * Time: 5:30 PM
 */

namespace App\Helpers;


use App\Services\IUserType;

class User
{

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public static function isAdmin(\App\Models\User $user){
        return self::isUserType($user, IUserType::ADMIN);
    }

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public static function isCustomer(\App\Models\User $user){
        return self::isUserType($user, IUserType::CUSTOMER);
    }

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public static function isBrand(\App\Models\User $user){
        return self::isUserType($user, IUserType::BRAND);
    }

    /**
     * @param \App\Models\User $user
     * @param $user_type
     * @return bool
     */
    private static function isUserType(\App\Models\User $user, $user_type){
        return $user->user_type === $user_type;
    }
}