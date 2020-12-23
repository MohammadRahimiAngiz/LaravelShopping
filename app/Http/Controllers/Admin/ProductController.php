<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        //ACL Users
        $this->middleware('can:show-products')->only(['index']);
        $this->middleware('can:create-product')->only(['create', 'store']);
        $this->middleware('can:edit-product')->only(['update', 'edit']);
        $this->middleware('can:delete-product')->only(['destroy']);
    }

    public function index()
    {
        $products = Product::query();
        if ($keyword = \request('search')) {
            $products = $products->where('title', 'LIKE', "%{$keyword}%")->orWhere('description', 'LIKE', "%{$keyword}%")->orWhere('id', $keyword);
        }
        $products = $products->latest()->paginate(5);
        return view('Admin.Products.index', ['products' => $products]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.Products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:products'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'description' => ['required',],
            'categories' => ['required', 'array'],
        ]);
        $data = $data + ['user_id' => $request->user()->id] + ['slug_title' => Str::slug($data['title'])];
        $product = Product::create($data);
//        $product = auth()->user()->products()->create($data);
//        dd($product);
        $product->categories()->sync($data['categories']);
        return redirect(route('admin.products.index'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('Admin.Products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'description' => ['required',],
            'categories' => ['required', 'array'],
        ]);
        $data = $data + ['user_id' => $request->user()->id] + ['slug_title' => Str::slug($data['title'])];
        $product->update($data);
        $product->categories()->sync($data['categories']);
        alert()->success("Product: * $product->title * is updated.");
        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
}
