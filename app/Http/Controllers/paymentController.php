<?php

namespace App\Http\Controllers;


use App\Payment;
use App\Services\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

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
            // Create new invoice.
            //todo $invoice = (new Invoice)->amount($price);
            $invoice = (new Invoice)->amount(1000);
            // Purchase and pay the given invoice.
            // You should use return statement to redirect user to the bank page.
            return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function ($driver, $transactionId) use ($order, $invoice) {
                // Store transactionId in database as we need it to verify payment in the future.
                $order->payments()->create([
                    'resNumber' => $invoice->getUuid(),
                ]);
                Cart::flush();
            })->pay()->render();
        }
        return back();
    }

    public function callback(Request $request)
    {
        // You need to verify the payment to ensure the invoice has been paid successfully.
        ////// We use transaction id to verify payments
        // It is a good practice to add invoice amount as well.
        try {
            $payment = Payment::with('order')->where('resNumber', $request->clientrefid)->firstOrFail();
            //todo $receipt = ShetabitPayment::amount($payment->order->price)->transactionId($request->clientrefid)->verify();
            $receipt = ShetabitPayment::amount(1000)->transactionId($request->clientrefid)->verify();
            $payment->update([
                'status' => 1,
            ]);
            $payment->order()->update([
                'status' => 'paid',
            ]);
            alert()->success('Successful');
            return redirect('/products');
        } catch (InvalidPaymentException $exception) {
            /**
             * when payment is not verified, it will throw an exception.
             * We can catch the exception to handle invalid payments.
             * getMessage method, returns a suitable message that can be used in user interface.
             **/
//            return $exception->getMessage();
            alert()->error($exception->getMessage());
            return redirect('/products');
        }
    }
}
