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

    public function getLatest($count = 20)
    {
        return Order::latest()->limit($count)->get();
    }

}
