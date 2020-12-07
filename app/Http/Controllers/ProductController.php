<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('home.products', compact('products'));
    }

    public function single($slug_title)
    {
        $product = Product::where('slug_title', $slug_title)->first();
//        dd($product->slug_title);
        return view('home.singleProduct', compact('product'));
    }
}
