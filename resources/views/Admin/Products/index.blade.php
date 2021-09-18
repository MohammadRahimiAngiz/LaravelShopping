@component('Admin.layouts.content',['title' => 'Products List'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb  ">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Products</div>
        </div>
    @endslot
    <p class="section-lead ">Products With its own users</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products
                        @if (request('search'))
                            <small class="section-lead ml-0 text-muted">: Search Result For: *{{request('search')}}* =
                                <strong>{{$products->total()}}</strong></small>
                        @endif
                    </h4>
                    <div class="card-header-form">
                        <x-search></x-search>
                    </div>
                    <div class="card-header-form">
                        <a href="{{request()->fullUrlWithQuery(['search'=>null])}}"
                           class="btn btn-primary btn-sm ml-2">
                            <i class="fas fa-th mr-1"></i>
                        </a>
                    </div>
                    @can('create-Product')
                        <div class="card-header-form">
                            <a href="{{route('admin.products.create')}}" class="btn btn-primary ml-2"><i
                                    class="fas fa-plus-square mr-1"></i>New Product</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped v_center">
                            <tbody>
                            <tr>
                                <th>
                                    Index Image
                                </th>
                                <th>ID</th>
                                <th>Title<br/><small class="text-muted">User</small></th>
                                <th>Description</th>
                                <th>Categories</th>
                                <th>Price</th>
                                <th>Stock</th>
                                @canany(['edit-product','delete-product'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                            @foreach ($products as $product)
                                <tr>
{{--                                    <td class="">--}}
{{--                                        <div class="custom-checkbox custom-control">--}}
{{--                                            <input type="checkbox" data-checkboxes="mygroup"--}}
{{--                                                   class="custom-control-input" id="{{'checkbox'.$product->id}}">--}}
{{--                                            <label for="{{'checkbox'.$product->id}}"--}}
{{--                                                   class="custom-control-label">&nbsp;</label>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                    <td>
                                        <figure class=" mr-2" >
                                            <img src="{{$product->image}}" alt="{{$product->id}}" width="60px" style="border-radius: 4px;">
                                        </figure>
                                    </td>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}<br/><small class="text-muted">{{$product->user->name}}</small></td>
                                    <td>{{$product->description}}</td>
                                    <td>
                                        <ul>
                                            @foreach ($product->categories as $category)
                                                <li>{{$category->name}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>
                                        @can('delete-product')
                                            <form action="{{route('admin.products.destroy',['product'=>$product->id])}}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        @endcan
                                        @can('edit-product')
                                            <a href="{{route('admin.products.edit',[$product->id])}}" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                        @endcan
                                            <a href="{{route('admin.product.gallery.index',['product'=>$product->id])}}" class="btn btn-success btn-sm">
                                               Gallery
                                            </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $products->appends(['search'=>request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
