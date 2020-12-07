@component('Admin.layouts.content',['title' => 'Roles List'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Roles</div>
        </div>
    @endslot
    <p class="section-lead">Roles With its own Permissions</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Roles
                        @if (request('search'))
                            <small class="section-lead ml-0 text-muted">: Search Result For: *{{request('search')}}* =
                                <strong>{{$roles->total()}}</strong></small>
                        @endif
                    </h4>
                    <div class="card-header-form">
                        <form>
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{request('search')}}"
                                       placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header-form">
                        <a href="{{request()->fullUrlWithQuery(['search'=>null])}}"
                           class="btn btn-primary btn-sm ml-2">
                            <i class="fas fa-th mr-1"></i>
                        </a>
                    </div>
                    @can('create-role')
                        <div class="card-header-form">
                            <a href="{{route('admin.roles.create')}}" class="btn btn-primary ml-2"><i
                                    class="fas fa-plus-square mr-1"></i>New Role</a>
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
                                <th>Name<br/><small class="text-muted">Permissions</small></th>
                                <th>Description</th>
                                @canany(['edit-role','delete-role'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup"
                                                   class="custom-control-input" id="{{'checkbox'.$role->id}}">
                                            <label for="{{'checkbox'.$role->id}}"
                                                   class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}<br/>
                                        @if ($role->permissions->count()>1)
                                            @foreach ( $role->permissions->pluck('name') as $permission)
                                                <small class="text-muted">  {{$permission}} , </small>
                                            @endforeach
                                        @else
                                            <small
                                                class="text-muted">{{$role->permissions->pluck('name')->first()}}</small>
                                        @endif
                                    </td>
                                    <td>{{$role->label}}</td>
                                    <td>
                                        @can('delete-role')
                                            <form action="{{route('admin.roles.destroy',['role'=>$role->id])}}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        @endcan
                                        @can('edit-role')
                                            <a href="{{route('admin.roles.edit',[$role->id])}}"
                                               class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $roles->appends(['search'=>request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
