<?php

namespace App\Http\Requests;

class ScoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';

        return $rules = [
            'description' => 'bail|required|max:65000',
            'score' => 'bail|required'
        ];
    }
}
