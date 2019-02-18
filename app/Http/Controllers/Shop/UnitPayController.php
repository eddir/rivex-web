<?php

namespace App\Http\Controllers\Shop;

use App\ {
    Http\Controllers\Controller,
    Http\Requests\Shop\OrderRequest,
    Models\Product,
    Models\Order,
    Models\PaymentType
};

use Illuminate\Http\Request;

class UnitPayController extends Controller
{
    /**
     * Search the order if the request from unitpay is received.
     * Return the order with required details for the unitpay request verification.
     *
     * @param Request $request
     * @param $order_id
     * @return mixed
     */
    public static function searchOrderFilter(Request $request, $order_id) {

        // If the order with the unique order ID exists in the database
        $order = Order::where('id', $order_id)->first();

        if ($order) {
            $order['UNITPAY_orderSum'] = $order->amount; // from your database
            $order['UNITPAY_orderCurrency'] = 'RUB';  // from your database

            // if the current_order is already paid in your database, return strict "paid";
            // if not, return something else
            $order['UNITPAY_orderStatus'] = $order->status; // from your database
            return $order;
        }

        return false;
    }

    /**
     * When the payment of the order is received from unitpay, you can process the paid order.
     * !Important: don't forget to set the order status as "paid" in your database.
     *
     * @param Request $request
     * @param $order
     * @return bool
     */
    public static function paidOrderFilter(Request $request, $order)
    {
        // Your code should be here:
        if ($order instanceof Order and $order->id) {
		$paymentType = PaymentType::where('codename', $request->params['paymentType'])->get()->first();
		
	        $order->status = 2;
		$order->method_id = $paymentType->id ?? null;
		$order->save();

		$commands = json_decode($order->product->execute);
		foreach ($commands as $cmd) {
			if ($cmd->type == "group") {
				if (\DB::connection('mysql2')->table('players')->where('userName', $order->username)->exists()) {
					\DB::connection('mysql2')->table('players')->where('userName', $order->username)->update(array('userGroup' => $cmd->execute));
				} else {
					\DB::connection('mysql2')->table('players')->insert(['userName' => strtolower($order->username), 'userGroup' => $cmd->execute, 'permissions' => ""]);
				}
			}
			elseif ($cmd->type == "money") {
				if(\DB::connection('mysql3')->table('user_money')->where('username', $order->username)->exists()) {
					\DB::connection('mysql3')->table('user_money')->increment('money', $cmd->execute);
				} else {
					\DB::connection('mysql3')->table('user_money')->insert(['username' => strtolower($order->username), 'money' => $cmd->execute]);
				}
			}
		}
		$order->status = 3;
		$order->save();
		return true;
	}

        // Return TRUE if the order is saved as "paid" in the database or FALSE if some error occurs.
        // If you return FALSE, then you can repeat the failed paid requests on the unitpay website manually.
        return false;
    }

    /**
     * Process the request from the UnitPay route.
     * searchOrderFilter is called to search the order.
     * If the order is paid for the first time, paidOrderFilter is called to set the order status.
     * If searchOrderFilter returns the "paid" order status, then paidOrderFilter will not be called.
     *
     * @param Request $request
     * @return mixed
     */
    public function payOrderFromGate(Request $request)
    {
        return \UnitPay::payOrderFromGate($request);
    }
}
