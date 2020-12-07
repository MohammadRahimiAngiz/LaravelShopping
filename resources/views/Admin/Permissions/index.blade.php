@component('Admin.layouts.content',['title' => 'Permissions List'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Permissions</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list Permissions.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Permissions
                        @if (request('search'))
                            <small class="section-lead ml-0 text-muted">: Search Result For: *{{request('search')}}* =
                                <strong>{{$permissions->total()}}</strong></small>
                        @endif
                    </h4>
                    <div class="card-header-form">
                        <x-search></x-search>
                    </div>
                    <div class="card-header-form">
                        <a href="{{request()->fullUrlWithQuery(['search'=>null])}}"
                           class="btn btn-primary btn-sm ml-2">
                            <i class="fas fa-th mr-1"></i>
                        </a>
                    </div>
                    @can('create-permission')
                        <div class="card-header-form">
                            <a href="{{route('admin.permissions.create')}}" class="btn btn-primary ml-2"><i
                                    class="fas fa-plus-square mr-1"></i>New Permission</a>
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
                                <th>Name</th>
                                <th>Description</th>
                                @canany(['edit-permission','delete-permission'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup"
                                                   class="custom-control-input" id="{{'checkbox'.$permission->id}}">
                                            <label for="{{'checkbox'.$permission->id}}"
                                                   class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->label}}</td>
                                    <td>
                                        @can('delete-permission')
                                            <form
                                                action="{{route('admin.permissions.destroy',['permission'=>$permission->id])}}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        @endcan
                                        @can('edit-permission')
                                            <a href="{{route('admin.permissions.edit',[$permission->id])}}"
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
                    {{ $permissions->appends(['search'=>request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
