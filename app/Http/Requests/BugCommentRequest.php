<?php

namespace App\Http\Requests;

class BugCommentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'body' => 'bail|required|max:65000',
        ];
    }
}
