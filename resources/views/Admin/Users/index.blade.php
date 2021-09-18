@component('Admin.layouts.content',['title' => 'List Users'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list users.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Users
                        @if (request('search'))
                            <small class="section-lead ml-0 text-muted">: Search Result For: *{{request('search')}}* =
                                <strong>{{$users->total()}}</strong></small>
                        @endif
                    </h4>
                    <div class="card-header-form">
                        <x-search></x-search>
                    </div>
                    <div class="card-header-form">
                        <a href="{{route('admin.users.index')}}"
                           class="btn btn-primary btn-sm ml-2">
                            <i class="fas fa-users mr-1"></i>
                        </a>
                    </div>
                    @can('show-admin-user')
                        <div class="card-header-form">
                            <a href="{{request()->fullUrlWithQuery(['admin'=>1,'search'=>null])}}"
                               class="btn btn-secondary ml-2"><i
                                    class="fas fa-user-cog mr-1"></i>Admin Users</a>
                        </div>
                    @endcan
                    @can('create-user')
                        <div class="card-header-form">
                            <a href="{{route('admin.users.create')}}" class="btn btn-primary ml-2"><i
                                    class="fas fa-user-plus mr-1"></i>New User</a>
                        </div>
                    @endcan
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
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Email Verify</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup"
                                                   class="custom-control-input" id="{{'checkbox'.$user->id}}">
                                            <label for="{{'checkbox'.$user->id}}"
                                                   class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        <img alt="image" src="/assets/img/avatar/avatar-5.png" class="rounded-circle"
                                             data-toggle="tooltip" title="" data-original-title="Wildan Ahdian"
                                             width="35">
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->email_verified_at)
                                        <td>
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="badge badge-danger">Inactive</div>
                                        </td>
                                    @endif
                                    <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans(['options' => 0])}}</td>
                                    <td>
                                        @can('delete-user')
                                            <form action="{{route('admin.users.destroy',['user'=>$user->id])}}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        @endcan
                                        @can('edit-user')
                                            <a href="{{route('admin.users.edit',[$user->id])}}"
                                               class="btn btn-primary btn-sm">Edit</a>
                                        @endcan
{{--                                        @if ($user->isStaffUser() || $user->isSuperUser())--}}
                                            @can('admin-user-permissions')
                                                <a href="{{route('admin.user.permissions',$user->id)}}"
                                                   class="btn btn-warning btn-sm">Permissions</a>
                                            @endcan
{{--                                        @endif--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $users->appends(['search'=>request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
