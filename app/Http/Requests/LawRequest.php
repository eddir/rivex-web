<?php

namespace App\Http\Requests;

class LawRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';
        $id = $this->law ? ',' . $this->law->id : '';

        return $rules = [
            'title' => 'bail|required|max:255',
            'description' => 'bail|required|max:65000',
            'location' => 'bail|required|max:20'
        ];
    }
}
