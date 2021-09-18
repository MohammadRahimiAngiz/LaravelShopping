<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\Collection;

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

    public function create()
    {
        $categories = Category::all();
        return view('Admin.Products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:products'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'description' => ['required',],
            'categories' => ['required', 'array'],
            'attributes' => ['array'],
            'image' => ['required',  'max:1024', 'min:30']
        ]);
        $data = $data + ['user_id' => $request->user()->id] + ['slug_title' => Str::slug($data['title'])];
        $product = auth()->user()->products()->create($data);
        $product->categories()->sync($data['categories']);
        if (isset($data['attributes'])) {
            $this->attachAttributesProduct($data['attributes'], $product);
        }
        return redirect(route('admin.products.index'));
    }

    public function edit(Product $product)
    {
        $arrData = [];
        foreach ($product->attributes as $attr) {
            array_push($arrData, [$attr['name'], $attr->pivot->value['value']]);
        }
        return view('Admin.Products.edit', ['product' => $product, 'arrData' => json_encode($arrData)]);
    }

    public function update(Request $request, Product $product)
    {

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'description' => ['required',],
            'categories' => ['required', 'array'],
            'image' => ['required', 'max:1024'],
            'attributes' => ['array'],
        ]);
//        if ($request->file('image')) {
//            $request->validate([
//                'image' => ['required', 'image', 'max:1024', 'min:30'],
//            ]);
//            if (File::exists(public_path($product->image))) {
//                File::delete(public_path($product->image));
//            }
//            $fileUpdate = $request->file('image');
//            $destinationPath = '/images/product/index/' . now()->year . '/' . now()->month . '/' . now()->day . '/';
//            $fileUpdate->move(public_path($destinationPath), $fileUpdate->getClientOriginalName());
//            $data['image'] = $destinationPath . $fileUpdate->getClientOriginalName();
//        }
        $data = $data + ['user_id' => $request->user()->id] + ['slug_title' => Str::slug($data['title'])];
        $product->update($data);
        $product->categories()->sync($data['categories']);
        $product->attributes()->detach();
        if (isset($data['attributes'])) {
            $this->attachAttributesProduct($data['attributes'], $product);
        }
        alert()->success("Product: * $product->title * is updated.");
        return back();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }

    protected function attachAttributesProduct($attributes1, Product $product): void
    {
        $attributes = collect($attributes1);
        $attributes->each(function ($item) use ($product) {
            if (is_null($item['name']) || is_null($item['value'])) return;
            $attr = Attribute::firstOrCreate(
                ['name' => $item['name']]
            );
            $attrValue = $attr->values()->firstOrCreate(
                ['value' => $item['value']]
            );
            $product->attributes()->attach($attr->id, ['value_id' => $attrValue->id]);
        });
    }
}
