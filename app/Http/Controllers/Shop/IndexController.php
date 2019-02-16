<?php

namespace App\Http\Controllers\Shop;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\Shop\OrderRequest,
    Repositories\OrderRepository,
    Models\Order,
    Models\Product,
    Models\Coupon,
    Models\Server,
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
        $servers = Server::where('production', 1)->get();
        return view('shop.index', compact('products', 'servers'));
    }

    public function calculateOrder($product_id, $coupon_name)
    {
        $product = Product::find($product_id);
        if ($product === null) {
            throw new \Exception('Product doesn\'t exist');
        }

        $coupon = null;
        $discount = 0;
        if ($coupon_name) {
            $coupon = Coupon::where('name', $coupon_name)->where('active', 1)->where(function ($query) {
               $query->where('valid_since', '<', date('Y-m-d H:i:s'))->orWhereNull('valid_since');  
           })->where(function ($query) {
               $query->where('valid_until', '>', date('Y-m-d H:i:s'))->orWhereNull('valid_until');
            })->first();
            if ($coupon !== null) {
                $discount = $coupon->amount / 100;
            }
        }

        $amount = round($product->price * (1 - $discount));

        if ($amount < 1) {
            $amount = 1;
        }

        return [$amount, $product, $coupon];
    }

    public function sum(OrderRequest $request)
    {
        return response()->json(['ok' => true, 'attachments' => [
            'total' => $this->calculateOrder($request->product, $request->coupon)[0]
        ]]);
    }

    public function pay(OrderRequest $request)
    {
        list($amount, $product, $coupon) = $this->calculateOrder($request->product, $request->coupon);
        $server = Server::find($request->gameserver);

        $order = Order::create([
            'amount' => $amount,
            'username' => $request->username,
            'email' => $request->email,
            'server_id' => $server->id,
            'product_id' => $product->id,
            'coupon_id' => $coupon->id ?? null
        ]);
        
        return \UnitPay::generatePaymentForm(
            $amount,
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
