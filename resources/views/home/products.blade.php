@extends('home.layouts.masterHome')
@section('content')
    <section class="section">
        <div class="section-header bg-transparent">
            <h1>Products</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Products</a></div>
                <div class="breadcrumb-item">Product</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">All Products</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article article-style-b" style="min-height: 93%;border-radius: 20px;-webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.36);box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.36);">
                            <div class="article-header">
                                <div class="article-image" data-background="{{$product->image}}" style="background-image: url({{$product->image}});border-radius: 20px;">
                                </div>
                                <div class="article-badge">
                                    <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> Trending</div>
                                </div>
                            </div>
                            <div class="article-details pb-0" style="border-radius: 20px;">
                                <div class="article-title">
                                    <h2><a href="{{url("product/$product->slug_title")}}">{{$product->title}}</a></h2>
                                </div>
                                <p>{{$product->description}} </p>
                                <div class="article-cta">
                                    <small class="text-muted float-left">Price: <strong>{{$product->price}} $</strong></small>
                                    <a href="{{url("product/$product->slug_title")}}">Read More <i class="fas fa-chevron-right"></i></a>
                                </div>
                                @if ($product->categories)
                                    <div class="badges mt-2">
                                        @foreach ($product->categories as $category)
                                            <a href="#" class="badge badge-primary">{{$category->name}}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="section-lead text-center">
            {{ $products->links() }}
        </div>
    </section>
@endsection
