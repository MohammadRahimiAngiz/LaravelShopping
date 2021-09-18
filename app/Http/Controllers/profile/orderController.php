<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Order;
//use App\Services\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;

class orderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);;
        return view('profile.orderList', compact('orders'));

    }

    public function showDetails(Order $order)
    {
        $this->authorize('view',$order);
        return view('profile.orderDetails',compact('order'));
    }

    public function payment(Order $order)
    {
        $this->authorize('view',$order);
        //todo $invoice = (new Invoice)->amount($order->price);
        $invoice = (new Invoice)->amount($order->price);
        // Purchase and pay the given invoice.
        // You should use return statement to redirect user to the bank page.
        return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function ($driver, $transactionId) use ($order, $invoice) {
            // Store transactionId in database as we need it to verify payment in the future.
            $order->payments()->create([
                'resNumber' => $invoice->getUuid(),
            ]);
//            Cart::flush();
        })->pay()->render();
    }
}
