<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:191',
            'description'   => 'required',
            'location'      => 'required|max:191',
            'reward'        => 'required|integer',
            'status'        => 'required|integer',
            'user_id'       => 'required|integer',
        ];
    }
}
