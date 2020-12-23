<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        //ACL Users
        $this->middleware('can:show-categories')->only(['index']);
        $this->middleware('can:create-category')->only(['create', 'store']);
        $this->middleware('can:edit-category')->only(['update', 'edit']);
        $this->middleware('can:delete-category')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::query();
        if ($keyword = \request('search')) {
            $categories = $categories->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('id', $keyword)
                ->latest()
                ->paginate(5);
        }else{
            $categories = Category::whereParent(0)->latest()->paginate(5);
        }


        return view('Admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->parent) {
            $parent = 0;
        } else {
            $parent = $request->parent;
        };
        return view('Admin.Categories.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required',
        ]);
        $validData = $validData + ['parent' => $request->parent];
        Category::create($validData);
        alert()->success('saved');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category=Category::whereId($id)->first();
        return view('Admin.Categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request,Category $category)
    {
        $data = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category->id)],
        ]);
//
        $category->update($data);
        alert()->success("category: *$category->name* is updated.");
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if(!$category->child->count()) {
            $category->delete();
            alert()->success('deleted');
        }else {
            alert()->error('Parent is Child');
        }
        return back();
    }
}
