<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Challenge
 * @package App\Models
 *
 * @property \App\Models\User $brand
 */
class Challenge extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'location','status', 'reward', 'user_id'
    ];
}
