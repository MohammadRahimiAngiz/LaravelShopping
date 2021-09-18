@component('Admin.layouts.content',['title'=>'Edit Product:' ])
    @slot('css')
        <link rel="stylesheet" href="/css/admin/css/select2.min.css">
    @endslot
    @slot('script')
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                document.getElementById('button-image').addEventListener('click', (event) => {
                    event.preventDefault();

                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                });
            });

            // set file link
            function fmSetLink($url) {
                document.getElementById('image_label').value = $url;
            }
        </script>
        <script src="/js/admin/select2.full.min.js"></script>

    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Products</a></div>
            <div class="breadcrumb-item">Edit Product</div>
        </div>
    @endslot
    <p class="section-lead">{{$product->title}}</p>
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.products.update',[$product->id])}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    @if($product->image !== '')
                        <div class="form-group text-center">
                            <p class="text-muted text-center">{{$product->title}} index image </p>
                            <img src="{{$product->image}}" alt="{{$product->title}}"
                                 style="border-radius: 5px;margin: 0 auto;" width="300px">
                            <p class="text-muted text-center"><small>{{$product->image}}</small></p>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Upload & edit index image</label>
                        {{--                        <div class="input-group">--}}
                        {{--                            <div class="input-group-prepend">--}}
                        {{--                                <div class="input-group-text">--}}
                        {{--                                    <i class="fas fa-image"></i>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <input name="image" id="image" type="file"--}}
                        {{--                                   class="form-control  @error('image')is-invalid @enderror">--}}
                        {{--                            @error('image')--}}
                        {{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}
                        <div class="input-group">
                            <input type="text" id="image_label"
                                   class="form-control @error('image')is-invalid @enderror" name="image" value="{{$product->image}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary text-white @error('image')is-invalid @enderror"
                                        type="button" id="button-image"><i
                                        class="fas fa-image"></i> Select Image
                                </button>
                            </div>
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product</label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title')is-invalid @enderror"
                               value="{{ old('title',$product->title) }}" required autocomplete="title" autofocus>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label>Description</label>
                        <textarea
                            class="form-control @error('description')is-invalid @enderror"
                            rows="3"
                            name="description"
                            id="description"
                            required autocomplete="description">{{old('description',$product->description)}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <input name="price" id="price" type="number" value="{{ old('price',$product->price) }}"
                                   class="form-control currency @error('price')is-invalid @enderror">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-hand-spock"></i>
                                </div>
                            </div>
                            <input name="stock" id="stock" type="number" value="{{old('stock',$product->stock)}}"
                                   class="form-control @error('stock')is-invalid @enderror">
                            @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Categories</label>
                        <select class="form-control select2" multiple="" required name="categories[]">
                            @foreach (\App\Category::all() as $category)
                                <option
                                    {{in_array($category->id,$product->categories->pluck('id')->toArray()) ? 'selected' : ''}}
                                    value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h2 class="section-title">Attributes Product</h2>
                    <hr>
                    {{--                    <attribute-add :attributes-product="{{ $product->attributes->pluck('name') }}">--}}
                    <attribute-add :attributes-product="{{ $arrData }}"></attribute-add>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-tractor mr-1"></i>Save Edit Product</button>
                    <a href="{{route('admin.products.index')}}" class="btn btn-secondary"><i
                            class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
