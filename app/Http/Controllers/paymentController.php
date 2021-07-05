<?php

namespace App\Http\Controllers;


use App\Services\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class paymentController extends Controller
{
    public function payment()
    {
        $cartItems = Cart::all();
        if ($cartItems->count()) {
            $price = $cartItems->sum(function ($cart) {
                return $cart['product']->price * $cart['quantity'];
            });
            $orderItems = $cartItems->mapWithKeys(function ($cart) {
                return [$cart['product']->id => ['quantity' => $cart['quantity']]];
            });
            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $price,

            ]);
            $order->products()->attach($orderItems);
            $token = config('services.payPing.token');
            $resNumber = Str::random(12);
            $args = [
                "amount" => 1000,
//                "payerIdentity" => "شناسه کاربر در صورت وجود",
                "payerName" => auth()->user()->name,
//                "description" => "توضیحات",
                "returnUrl" => route('payment.callback'),
                "clientRefId" => $resNumber
            ];

            $payment = new \PayPing\Payment($token);

            try {
                $payment->pay($args);
            } catch (\Exception $e) {
//                var_dump($e->getMessage());
                throw $e;
            }
//echo $payment->getPayUrl();

//            header('Location: ' . $payment->getPayUrl());
//            dd($payment->getPayUrl());
            return redirect($payment->getPayUrl());
        }
        return back();
    }

    public function callback()
    {
        return 'ok';
    }
}