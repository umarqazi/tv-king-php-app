<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 *
 * @property integer $id
 * @property-read string $name
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property integer $user_type
 * @property string $profile_image
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property \App\Models\Image $profileImage
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user_type' => $this->user_type,
        ];
    }

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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profileImage(){
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    /**
     * @param $password
     * @return bool
     */
    public function verifyPassword($password){
        return Hash::check($password, $this->getAuthPassword());
    }

    /**
     * @return string
     */
    public function getNameAttribute(){
        return ucfirst( strtolower($this->first_name)) . ' ' . ucfirst( strtolower($this->last_name));
    }
}
