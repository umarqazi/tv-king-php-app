<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Challenge
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $location
 * @property integer $status
 * @property string $reward
 * @property integer $brand_id
 * @property \App\Models\User $brand
 * @property Tag[] $tags
 */
class Challenge extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'location','status', 'reward', 'brand_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(){
        return $this->belongsToMany('App\Models\Tag')->using('App\Models\TagChallenge');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand(){
        return $this->hasOne(User::class, 'id', 'brand_id');
    }
}
