@component('Admin.layouts.content',['title'=>'New Image'])
    @slot('css')

    @endslot
    @slot('script')
        <script>
            // CKEDITOR.replace('description', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
            // CKEDITOR.replace('description');
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
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Products</a></div>
            <div class="breadcrumb-item">{{$product->title}}</div>
            <div class="breadcrumb-item">Image Entry</div>
        </div>
    @endslot
    <div class="col-12 col-lg-12 col-md-12 p-0">
        <div class="card">
            <form action="{{route('admin.product.gallery.store',['product'=>$product->id])}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title')is-invalid @enderror"
                               value="{{ old('title') }}" required autocomplete="title" autofocus>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="form-group ">--}}
{{--                        <label>Description</label>--}}
{{--                        <textarea--}}
{{--                            class="form-control @error('description')is-invalid @enderror"--}}
{{--                            rows="10" cols="80"--}}
{{--                            name="description"--}}
{{--                            id="description"--}}
{{--                            autocomplete="description">{{ old('description') }}</textarea>--}}
{{--                        @error('description')--}}
{{--                        <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Price</label>--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    <i class="fas fa-dollar-sign"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <input name="price" id="price" type="number" value="{{old('price')}}"--}}
{{--                                   class="form-control currency @error('price')is-invalid @enderror">--}}
{{--                            @error('price')--}}
{{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Stock</label>--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <div class="input-group-text">--}}
{{--                                    <i class="fas fa-hand-spock"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <input name="stock" id="stock" type="number" value="{{old('stock')}}"--}}
{{--                                   class="form-control @error('stock')is-invalid @enderror">--}}
{{--                            @error('stock')--}}
{{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Select Categories</label>--}}
{{--                        <select class="form-control select2" multiple="" required name="categories[]">--}}
{{--                            @foreach ($categories as $category)--}}
{{--                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label>Upload index image</label>
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
                                   class="form-control @error('image')is-invalid @enderror" name="image">

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
{{--                    <h2 class="section-title">Attributes Product</h2>--}}
{{--                    <hr>--}}
{{--                    <attribute-add :attributes-product="''"></attribute-add>--}}
                </div>

                <div class="card-footer text-right">
                    <get-image-gallery-product></get-image-gallery-product>
                    <button class="btn btn-primary">
                        <i class="far fa-image mr-1"></i>
                        Save New Image
                    </button>
                    <a href="{{route('admin.product.gallery.index',['product'=>$product->id])}}" class="btn btn-secondary">
                        <i class="fas fa-undo mr-1"></i>
                        Cancel
                    </a>

                </div>
            </form>
        </div>
    </div>
@endcomponent
