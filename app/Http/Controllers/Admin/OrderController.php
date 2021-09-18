<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function __construct()
    {
        //ACL Users
        $this->middleware('can:show-order')->only(['index']);
        $this->middleware('can:edit-order')->only(['update', 'edit']);
        $this->middleware('can:delete-order')->only(['destroy']);
    }

    public function index()
    {
//        $backgroundColor = "";
        switch (\request('type')) {
            case "paid":
                $backgroundColor = "#E1DDE6";
                break;
            case "unpaid":
                $backgroundColor = "#F2EBD9";
                break;
            case "preparation":
                $backgroundColor = "#D8E3F3";
                break;
            case "canceled":
                $backgroundColor = "#ECDBDD";
                break;
            case "posted":
                $backgroundColor = "#DEDDE1";
                break;
            case "received":
                $backgroundColor = "#E1E9E2";
                break;
        }
//        dd($backgroundColor);
        $orders = Order::query();
        if ($search = \request('search')) {
            $orders = Order::whereId($search)->orWhere('tracking_serial', $search);
        }
        $orders = $orders->where('status', request('type'))->latest()->paginate(6);
        return view('Admin.Orders.index', compact('orders', 'backgroundColor'));
    }

    public function show(Order $order, Request $request)
    {
        $pageOrder = $request['pageCurrent'];
        $products = $order->products()->paginate(15);
//        dd($products);
        return view('admin.orders.details', compact('products', 'order', 'pageOrder'));
    }

    public function payments(Order $order)
    {
        $payments = $order->payments()->latest()->paginate(15);
        return view('admin.orders.payments', compact('payments', 'order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $data = $this->validate($request, [
            'status' => ['required', Rule::in(['paid', 'unpaid', 'preparation', 'posted', 'received', 'canceled'])],
            'trackingSerial' => ['nullable', 'numeric']
        ]);
        $order->update($data);
        //todo alert
        return redirect(route('admin.orders.index') . "?type=$order->status");
    }


    public function destroy(Order $order)
    {
        $order->delete();
        //todo alert
        return back();
    }
}
