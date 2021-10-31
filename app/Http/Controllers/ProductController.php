<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //Seo Title & Description
        $this->seo()
            ->setTitle('Handmade Art Products')
            ->setDescription('Painting on T-shirts, scarves, shawls, batik printing');
        //end Seo Title & Description
        $products = Product::latest()->paginate(10);
        return view('home.products', compact('products'));
    }

    public function single(Product $product)
    {
        return view('home.singleProduct', compact('product'));
    }
}
