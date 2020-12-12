@foreach ( $childComments as $childComment)
    <div class="card mr-3 ml-3 bg-white ">
        <div class="card-header">
            <img class="mr-3" src="/assets/img/example-image-50.jpg"
                 alt="Generic placeholder image">
            <h4><strong>{{$childComment->user->name}}</strong></h4>
            @auth
                <div class="card-header-action">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-light btn-sm"
                            data-toggle="modal"
                            data-target="#myModal"
                            data-id="{{$childComment->id}}"
                    >
                        <i class="fas fa-comment-dots"></i>
                        {{__('Opinion')}}
                    </button>
                </div>
            @endauth
        </div>
        <div class="card-body ">
            <div class="media">
                <div class="media-body">
                    <p>{{$childComment->comment}}</p>
                </div>
            </div>
        </div>
        @include('home.partial.commentPartial',['childComments' => $childComment->child])
    </div>
@endforeach
