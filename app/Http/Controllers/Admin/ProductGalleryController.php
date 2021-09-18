<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\ProductGallery;

class ProductGalleryController extends Controller
{
    public function getImages(Product $product)
    {
        return $product->images()->get();
    }
    public function index(Product $product)
    {
        return view('admin.Products.gallery.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('Admin.Products.Gallery.create', compact('product'));
    }

    public function store(Product $product, Request $request)
    {
        $product->images()->firstOrCreate(
            ['image'=>$request['image']],
            ['alt' =>$request['alt']]);
        return $product->images()->get();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Product $product , $id)
    {
        $product->images()->find($id)->delete();
        return  $product->images()->get();
    }
}
