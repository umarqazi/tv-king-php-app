<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property array|\App\Models\Challenge $challenges
 */
class Tag extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function challenges(){
        return $this->hasManyThrough(Challenge::class, TagChallenge::class, 'tag_id', 'challenge_id', 'id', 'challenge_id');
    }

}
