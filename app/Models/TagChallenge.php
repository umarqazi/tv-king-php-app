<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 7:54 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TagChallenges
 * @package App\Models
 *
 * @property integer $challenge_id
 * @property integer $tag_id
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class TagChallenge extends Model
{
    protected $table = 'challenges_tags';

}