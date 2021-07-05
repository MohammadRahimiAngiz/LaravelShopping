<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
//        return Cart::all();
        return view('home.cart');
    }

    public function addToCart(Product $product)
    {

        if (Cart::has($product)) {
            if (Cart::count($product) < $product->stock) Cart::update($product, 1);
        } else {
            Cart::put([
                'quantity' => 1,
            ],
                $product
            );
        };
        return redirect('/cart');
    }

    public function quantityChange(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required',
            'id' => 'required',
//            'cart' => 'required',
        ]);
//        return $data;
        if (Cart::has($data['id'])) {
            Cart::update($data['id'], [
                'quantity' => $data['quantity']
            ]);
            return response(['status' => 'success']);
        }
        return response(['status' => 'error'], 404);
    }

    public function deleteFromCart($id)
    {
        Cart::delete($id);
        return back();
    }
}
