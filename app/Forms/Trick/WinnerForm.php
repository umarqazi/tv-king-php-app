<?php
/**
 * Created by PhpStorm.
 * User: qazi
 * Date: 2/28/19
 * Time: 2:51 PM
 */

namespace App\Forms\Trick;


use App\Forms\BaseForm;

class WinnerForm extends BaseForm
{
    public $challenge_id;
    public $trick_id;
    public $winner_notes;

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
            'winner_notes' => $this->winner_notes,
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'challenge_id' => 'required',
            'trick_id' => 'required',
        ];
    }
}