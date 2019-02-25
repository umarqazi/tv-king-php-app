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
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $location
 * @property integer $status
 * @property string $reward
 * @property string $reward_notes
 * @property string $reward_url
 * @property boolean $published
 * @property integer $brand_id
 * @property \App\Models\User $brand
 * @property Tag[] $tags
 */
class Challenge extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(){
       return $this->hasManyThrough(Tag::class, TagChallenge::class, 'challenge_id', 'id', 'id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tricks(){
        return $this->hasMany(Trick::class, 'challenge_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand(){
        return $this->belongsTo(User::class, 'brand_id', 'id');
    }


}
