@extends('home.layouts.masterHome')
@section('css')
@endsection
@section('script')
    <script>
        $('.modal').on('shown.bs.modal', function () {
            $('#comment').trigger('focus')
        })
        document.querySelector('#sendCommentForm').addEventListener('submit', function (event) {
            event.preventDefault();
            let target = event.target;
            let data = {
                commentable_id: target.querySelector('input[name="commentable_id"]').value,
                commentable_type: target.querySelector('input[name="commentable_type"]').value,
                parent_id: target.querySelector('input[name="parent_id"]').value,
                comment: target.querySelector('textarea[name="comment"]').value,
            }
            // console.log(document.head.querySelector('meta[name="csrf-token"]').content);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
            });
            $.ajax({
                type: 'POST',
                url: '/comments',
                data: JSON.stringify(data),
                success: function (dataResponse) {
                    alert('good');
                    console.log(dataResponse);
                },

            });
            // console.log(data);
        });
    </script>
@endsection
@section('content')
    <section class="section">
        <div class="section-header mt-3">
            <div class="section-header-breadcrumb ml-0">
                <div class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></div>
                <div class="breadcrumb-item"><a href="{{url('/products')}}">Products</a></div>
                <div class="breadcrumb-item">Product</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{$product->title}}</h2>
            <p>{{$product->description}} </p>
            <div class="article-cta">
                <small class="text-muted ">Price: <strong>{{$product->price}} $ </strong>, Stock:
                    <strong>{{$product->stock}}</strong></small>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    @foreach ($product->comments()->where('parent_id',0)->get() as $comment)
                        <div class="card">
                            <div class="card-header">
                                <img class="mr-3" src="/assets/img/example-image-50.jpg"
                                     alt="Generic placeholder image">
                                <h4><strong>{{$comment->user->name}}</strong></h4>
                                @auth
                                    <div class="card-header-action">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#myModal">
                                            {{__('Post a Comment')}}
                                        </button>
                                    </div>
                                @endauth
                            </div>
                            <div class="card-body ">
                                <div class="media">

                                    <div class="media-body">
                                        {{--                                        <h5 class="mt-0">{{$comment->user->name}}</h5>--}}
                                        <p>{{$comment->comment}}</p>

                                        {{--                                    <div class="media mt-3">--}}
                                        {{--                                        <a class="pr-3" href="#"><img src="/assets/img/example-image-50.jpg"--}}
                                        {{--                                                                      alt="Generic placeholder image"></a>--}}
                                        {{--                                        <div class="media-body">--}}
                                        {{--                                            <h5 class="mt-0">Media heading</h5>--}}
                                        {{--                                            <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus--}}
                                        {{--                                                scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate--}}
                                        {{--                                                at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate--}}
                                        {{--                                                fringilla. Donec lacinia congue felis in faucibus.</p>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </section>
    @auth
        <!-- Modal -->
        <div class="modal fade " id="myModal"
             tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true"
             data-backdrop="static"
        >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Post a comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('send.comment')}}" method="post" id="sendCommentForm">
                        @csrf
                        <input type="hidden" name="commentable_id" value="{{$product->id}}">
                        <input type="hidden" name="commentable_type" value="{{get_class($product)}}">
                        <input type="hidden" name="parent_id" value="0">
                        <div class="modal-body">
                            <textarea name="comment" id="comment"
                                      class="form-control @error('comment') is-invalid @enderror " required></textarea>
                            @error('comment')
                            <div class="invalid-feedback">Oh no! You entered an inappropriate word.</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth

@endsection
