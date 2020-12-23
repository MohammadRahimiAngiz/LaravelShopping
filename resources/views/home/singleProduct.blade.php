@extends('home.layouts.masterHome')
@section('css')
@endsection
@section('script')
    <script>

        $('.modal').on('shown.bs.modal', function (event) {
            $('#comment').trigger('focus')
            var button = $(event.relatedTarget);
            // let id = button.data('id');
            $('input[name=parent_id]').val(button.data('id'));
        });
        // document.querySelector('#sendCommentForm').addEventListener('submit', function (event) {
        //     event.preventDefault();
        //     let data = {
        //         commentable_id: event.target.querySelector('input[name="commentable_id"]').value,
        //         commentable_type: event.target.querySelector('input[name="commentable_type"]').value,
        //         parent_id: event.target.querySelector('input[name="parent_id"]').value,
        //         comment: event.target.querySelector('textarea[name="comment"]').value,
        //     }
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
        //             'Content-Type': 'application/json',
        //         },
        //     });
        //     $.ajax({
        //         type: 'POST',
        //         url: '/comments',
        //         data: JSON.stringify(data),
        //         success: function (dataResponse) {
        //             alert('good');
        //             // console.log(dataResponse);
        //         },
        //
        //     });
        //
        // });
        // $('.modal').modal('hide');
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
            <h3 class="">{{$product->title}}</h3>
            <p>{{$product->description}} </p>
            <div class="article-cta">
                <small class="text-muted ">Price: <strong>{{$product->price}} $ </strong>, Stock:
                    <strong>{{$product->stock}}</strong></small>
            </div>
            @if ( $product->comments()->count())
                <div class="row">
                    <div class="col-12 col-md-3 col lg-3">
                        <h1 class="section-title mt-4 mb-0">Comments</h1>
                        @guest()
                            <div class="article-cta mb-4">
                                <a href="/login">
                                    <small class="text-muted">
                                        ... Login is required to post comments
                                    </small>
                                </a>
                            </div>
                        @endguest
                    </div>
                    <div class="col-12 col-md-3 col-lg-3 text-right pt-4 pb-2">
                        @auth
                            <button type="button" class="btn btn-primary btn-sm"
                                    data-toggle="modal"
                                    data-target="#myModal"
                                    data-id="0"
                            >
                                <i class="far fa-comment"></i>
                                {{__('New')}}
                            </button>
                        @endauth
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    @foreach ($product->comments()->where('parent_id',0)->latest()->get() as $comment)
                        <div class="card">
                            <div class="card-header">
                                <img class="mr-3" src="/assets/img/example-image-50.jpg"
                                     alt="Generic placeholder image">
                                    <h4><strong>{{$comment->user->name}}</strong><br/>
                                        <small class="text-muted ">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans(['options' => 0])}} </small>
                                    </h4>
                                @auth
                                    <div class="card-header-action ">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary"
                                                data-toggle="modal"
                                                data-target="#myModal"
                                                data-id="{{$comment->id}}"
                                        >
                                            <i class="fas fa-comment"></i>
                                            {{__('Comment')}}
                                        </button>
                                    </div>
                                @endauth
                            </div>
                            <div class="card-body ">
                                <div class="media">
                                    <div class="media-body">
                                        <p>{{$comment->comment}}</p>
                                    </div>
                                </div>
                            </div>
                            {{--                            partial--}}
                            @include('home.partial.commentPartial',['childComments' => $comment->child])
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
                        <input type="hidden" name="commentable_id" value="{{$product->id}}" >
                        <input type="hidden" name="commentable_type" value="{{get_class($product)}}">
                        <input type="hidden" name="parent_id" value="0">
                        <div class="modal-body">
                            <textarea name="comment"
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
