<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Challenge
 * @package App\Models
 *
 * @property string name
 * @property string description
 * @property string location
 * @property string status
 * @property string reward_url
 * @property integer brand_id
 * @property \App\Models\User $brand
 */
class Challenge extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'location','status', 'reward', 'brand_id'
    ];
}
