<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'location','status', 'reward', 'user_id'
    ];
}
