<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /*protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('email', '=', $this->getAttribute('email'))
            ->where('user_type', '=', $this->getAttribute('user_type'));
        return $query;
    }*/

    public function userExists($params){
       return $this->where('email', $params['email'])->where('user_type' , $params['user_type'])->first();
    }
    
}
