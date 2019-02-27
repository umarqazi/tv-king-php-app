<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 27/02/2019
 * Time: 7:19 PM
 */

namespace App\Forms\Challenge;

use App\Forms\BaseForm;

/**
 * Class WinnerForm
 * @package App\Forms\Challenge
 */
class WinnerForm extends BaseForm
{
    public $challenge_id;
    public $trick_id;
    public $notes;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'challenge_id' => $this->challenge_id,
            'trick_id' => $this->trick_id,
            'notes' => $this->notes
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'challenge_id' => 'required|integer',
            'trick_id' => 'required|integer'
        ];
    }
}