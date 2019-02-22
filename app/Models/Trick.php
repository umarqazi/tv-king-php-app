<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trick
 * @package App\Models
 *
 * @property integer $challenge_id
 * @property integer $customer_id
 * @property string $description
 * @property \App\Models\User $customer
 * @property \App\Models\Challenge $challenge
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Trick extends Model
{

    protected $table = 'tricks';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer(){
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function challenge(){
        return $this->hasOne(Challenge::class, 'id', 'challenge_id');
    }
}
