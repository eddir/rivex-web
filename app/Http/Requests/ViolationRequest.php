<?php

namespace App\Http\Requests;

class ViolationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';
        $id = $this->violation ? ',' . $this->violation->id : '';

        return $rules = [
            'location' => 'bail|required|max:20',
            'violator' => 'bail|required|max:64',
            'law_id' => 'required',
            'cause' => 'bail|required|max:65000',
            'term_start' => 'required',
            'term_end' => 'required'
        ];
    }
}
