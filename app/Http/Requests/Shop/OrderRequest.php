<?php

namespace App\Http\Requests\Shop;

use App\Http\Requests\Request;

class OrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'username' => 'required|max:255',
            'product' => 'required|numeric',
            'email' => 'required|email',
            'gameserver' => 'required|numeric',
            'coupon' => 'max:64'
        ];
    }
}
