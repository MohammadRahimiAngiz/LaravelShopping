@component('Admin.layouts.content',['title'=>'Edit Comment' ])
    @slot('css')
    @endslot
    @slot('script')
    @endslot
    @slot('breadcrumb')
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.comments.index')}}">comments</a></div>
            <div class="breadcrumb-item">Edit Comment</div>
        </div>
    @endslot
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.comments.update',[$comment->id])}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-muted">User:  {{$comment->user->name}}</label>
                        <textarea cols="30" rows="10" name="comment" id="comment"
                               class="form-control @error('comment')is-invalid @enderror"
                                   required autocomplete="name" autofocus>{{$comment->comment}}</textarea>
                        @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                    </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="custom-switch mt-2">--}}
{{--                                <input id="approved" type="checkbox" name="approved" class="custom-switch-input" value="{{$comment->approved}}">--}}
{{--                                <span class="custom-switch-indicator"></span>--}}
{{--                                <span class="custom-switch-description">Approved</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit mr-1"></i>Save</button>
                    <a href="{{route('admin.comments.index')}}" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
