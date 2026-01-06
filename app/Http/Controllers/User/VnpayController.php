<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class VnpayController extends Controller
{
    public function createPayment(Request $request)
    {
        $orderId = Session::get('vnpay_order_id');

        if (!$orderId) {
            return redirect()->route('cart.index')
                ->with('error', 'Order not found');
        }

        $order = Order::findOrFail($orderId);

        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_ReturnUrl = config('vnpay.vnp_Returnurl');

        $amountVnd = round($order->total * 25000);

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amountVnd * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Payment for order #" . $order->id,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $order->id,
        ];

        ksort($inputData);

        $hashData = '';
        $query = '';

        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $hashData = rtrim($hashData, '&');
        $query = rtrim($query, '&');

        $vnp_SecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        return redirect($vnp_Url . '?' . $query . '&vnp_SecureHash=' . $vnp_SecureHash);
    }

    public function return(Request $request)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? null;
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);

        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= $key . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash !== $vnp_SecureHash) {
            return redirect()->route('cart.index')
                ->with('error', 'Invalid VNPay signature');
        }

        $orderId = $request->vnp_TxnRef;
        $order = Order::findOrFail($orderId);

        if (
            $request->vnp_ResponseCode === '00' &&
            $request->vnp_TransactionStatus === '00'
        ) {
            Transaction::updateOrCreate(
                ['order_id' => $orderId],
                [
                    'user_id' => $order->user_id,
                    'mode' => 'vnpay',
                    'status' => 'approved'
                ]
            );

            $order->status = 'paid';
            $order->save();

            Cart::instance('cart')->destroy();
            Session::put('order_id', $order->id);
            Session::forget(['checkout', 'coupon', 'discounts', 'vnpay_order_id']);

            return redirect()
                ->route('user.checkout.orderConfirmation')
                ->with('success', 'Payment successful');
        }

        Transaction::where('order_id', $orderId)
            ->update(['status' => 'failed']);

        return redirect()->route('cart.index')
            ->with('error', 'VNPay payment failed');
    }


    public function ipn(Request $request)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? null;
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = "";

        foreach ($inputData as $key => $value) {
            $hashData .= $key . "=" . $value . "&";
        }

        $secureHash = hash_hmac(
            'sha512',
            rtrim($hashData, "&"),
            $vnp_HashSecret
        );

        if ($secureHash !== $vnp_SecureHash) {
            return response()->json([
                'RspCode' => '97',
                'Message' => 'Invalid signature'
            ]);
        }

        $orderId = $request->vnp_TxnRef;
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'RspCode' => '01',
                'Message' => 'Order not found'
            ]);
        }

        if ($order->status === 'paid') {
            return response()->json([
                'RspCode' => '02',
                'Message' => 'Order already confirmed'
            ]);
        }

        if ($request->vnp_ResponseCode === '00') {

            Transaction::where('order_id', $orderId)
                ->update(['status' => 'completed']);

            $order->status = 'paid';
            $order->save();

            return response()->json([
                'RspCode' => '00',
                'Message' => 'Confirm success'
            ]);
        }

        Transaction::where('order_id', $orderId)
            ->update(['status' => 'failed']);

        return response()->json([
            'RspCode' => '00',
            'Message' => 'Confirm failed'
        ]);
    }
}
