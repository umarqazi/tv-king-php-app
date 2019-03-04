<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 25/02/2019
 * Time: 11:42 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App\Models
 *
 * @property integer $id
 * @property string $storage_path
 * @property string $web_path
 * @property string $data
 * @property string $name
 * @property integer imageable_id
 * @property string imageable_type
 * @property mixed $imageable
 */
class Image extends Model
{
    protected $casts = [
        'data' => 'json'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

}