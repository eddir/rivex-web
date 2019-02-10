<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * Store post.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return void
     */
    public function store($request)
    {
        return Order::create($request->all());
    }

}
