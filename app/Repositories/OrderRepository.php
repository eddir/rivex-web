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

    public function getLatest($server, $count = 20)
    {
        return Order::where('server_id', $server)->latest()->limit($count)->get();
    }

    public function getLatestDays($server, $days = 14)
    {
        return Order::where('server_id', $server)->where('status', 3)
            ->where('updated_at', '>', new \DateTime("$days days ago"))
            ->groupBy('updated_at')
            ->select(array(
                \DB::raw('sum(amount) AS sum'),
                \DB::raw("DATE_FORMAT(created_at, '%d.%m') as date")
            ))->groupBy('date')->get();
    }

}
