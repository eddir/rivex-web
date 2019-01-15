<?php

namespace App\Http\Requests;

class BugRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';
        $id = $this->bug ? ',' . $this->bug->id : '';

        return $rules = [
            'title' => 'bail|required|max:255',
            'body' => 'bail|required|max:65000',
            'bug_important' => 'required',
            'bug_type' => 'required',
        ];
    }
}
