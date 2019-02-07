<?php

namespace App\Http\Controllers\Shop;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\Shop\OrderRequest,
    Repositories\OrderRepository,
    Models\Product
};

class IndexController extends Controller
{

    /**
     * Create a new CommentController instance.
     *
     * @param  \App\Repositories\OrderRepository $repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('active', 1)->get();
        return view('shop.index', compact('products'));
    }

    public function sum(OrderRequest $request)
    {
        $price = Product::find($request->product)->price;
        $amount = round($price);
        return response()->json(['ok' => true, 'attachments' => ['total' => $amount]]);
    }

    public function pay(OrderRequest $request)
    {
        $order = $this->repository->store($request);
        $product = Product::find($request->product);
        return \UnitPay::generatePaymentForm(
            $product->price,
            $order->id,
            $request->email,
            $product->title,
            config('unitpay.currency')
        );
    }

    public function list()
    {
        $products = Product::where('active', 1)->orderBy('price')->get();
        return view('shop.list', compact('products'));
    }

}
