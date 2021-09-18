@component('Admin.layouts.content',['title' => 'List of product images'])
    @slot('css')
    @endslot
    @slot('script')
        <script>
            // set file link
            function fmSetLink($url) {
                document.getElementById('image_label').value = $url;
            }
        </script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb  ">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Products</a></div>
            <div class="breadcrumb-item">{{$product->title}}</div>
            <div class="breadcrumb-item">Images Gallery</div>
        </div>
    @endslot
    <p class="section-lead ">Product With Images</p>
    <get-image-gallery-product :product-id="{{$product->id}}"></get-image-gallery-product>
@endcomponent
