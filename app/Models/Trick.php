<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trick
 * @package App\Models
 *
 * @property integer $challenge_id
 * @property integer $customer_id
 * @property \App\Models\User $customer
 * @property \App\Models\Challenge $challenge
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Trick extends Model
{

}
