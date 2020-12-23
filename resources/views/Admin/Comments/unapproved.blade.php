@component('Admin.layouts.content',['title' => 'List Unapproved Comments'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('admin.comments.index')}}">Comments</a></div>
            <div class="breadcrumb-item">Unapproved Comments List</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list Unapproved Comments.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Unapproved Comments
                        @if (request('search'))
                            <small class="section-lead ml-0 text-muted">: Search Result For: *{{request('search')}}* =
                                <strong>{{$comments->total()}}</strong></small>
                        @endif
                    </h4>
                    <div class="card-header-form">
                        <x-search></x-search>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped v_center">
                            <tbody>
                            <tr>
                                <th>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                               class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Comment</th>
                                <th>Comment For</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td class="">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup"
                                                   class="custom-control-input" id="{{'checkbox'.$comment->id}}">
                                            <label for="{{'checkbox'.$comment->id}}"
                                                   class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{$comment->comment}}</td>
                                    <td>{{$comment->commentable_type}}</td>
                                    <td>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans(['options' => 0])}}</td>
                                    <td>
                                        @can('delete-comment')
                                            <form action="{{route('admin.comments.destroy',['comment'=>$comment->id])}}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        @endcan
                                        @can('edit-comment')
                                            <form action="{{route('admin.comments.update',['comment'=>$comment->id])}}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="comment" value="{{$comment->comment}}">
                                                <button type="submit" class="btn btn-primary btn-sm ">Confirmation
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $comments->appends(['search'=>request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
