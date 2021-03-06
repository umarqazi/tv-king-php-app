<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
 * @property Trick $winner
 * @property Collection $tricks
 * @property integer $winner_id
 * @property string $winner_notes
 * @property \DateTime $winner_at
 * @property boolean hasWinner
 */
class Challenge extends Model
{
    use SpatialTrait;

    protected $spatialFields = [
        'location'
    ];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function winner(){
        return $this->hasOne(Trick::class, 'id', 'winner_id');
    }

    /**
     * @return bool
     */
    public function getHasWinnerAttribute(){
        return !blank($this->winner_id);
    }
}
