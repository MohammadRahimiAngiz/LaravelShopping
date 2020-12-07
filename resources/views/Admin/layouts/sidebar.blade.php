<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{config('app.name','M.Rahimi.A')}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index-2.html">MRA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{isActive('admin.dashboard','active')}}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cat"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{isActive('admin.dashboard','active')}}">
                        <a class="nav-link" href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Users panel</li>
            <li class="dropdown {{isActive('admin.users.index','active')}} {{isActive('admin.users.create','active')}} ">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-users"></i> <span>Users</span></a>
                <ul class="dropdown-menu">
                    @can('show-users')
                        <li class="{{isActive('admin.users.index','active')}}">
                            <a class="nav-link " href="{{route('admin.users.index')}}">List Users</a>
                        </li>
                    @endcan
                    @can('create-user')
                        <li class="{{isActive('admin.users.create','active')}}">
                            <a class="nav-link" href="{{route('admin.users.create')}}">New user</a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="menu-header">Products panel</li>
            <li class="dropdown {{isActive('admin.products.index','active')}} {{isActive('admin.products.create','active')}} ">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-coins" style="font-size: 16px;"></i> <span>Products</span></a>
                <ul class="dropdown-menu">
                    @can('show-products')
                        <li class="{{isActive('admin.products.index','active')}}">
                            <a class="nav-link " href="{{route('admin.products.index')}}">List Products</a>
                        </li>
                    @endcan
                    @can('create-product')
                        <li class="{{isActive('admin.products.create','active')}}">
                            <a class="nav-link" href="{{route('admin.products.create')}}">New Product</a>
                        </li>
                    @endcan
                </ul>
            </li>
{{--            @canany(['show-permissions','show-roles','create-permission','create-role'])--}}
                <li class="menu-header">Permissions panel</li>
                <li class="dropdown
                {{isActive('admin.permissions.index','active')}}
                {{isActive('admin.permissions.create','active')}}
                {{isActive('admin.roles.index','active')}}
                {{isActive('admin.roles.create','active')}}">
                    <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-shield-alt"></i>
                        <span>Permissions & Roles</span></a>
                    <ul class="dropdown-menu">
                        @can('show-permissions')
                            <li class="{{isActive('admin.permissions.index','active')}}">
                                <a class="nav-link " href="{{route('admin.permissions.index')}}">List Permissions</a>
                            </li>
                        @endcan
                        @can('create-permission')
                            <li class="{{isActive('admin.permissions.create','active')}}">
                                <a class="nav-link" href="{{route('admin.permissions.create')}}">New Permission</a>
                            </li>
                        @endcan
                        @can('show-roles')
                            <li class="{{isActive('admin.roles.index','active')}}">
                                <a class="nav-link " href="{{route('admin.roles.index')}}">List Roles</a>
                            </li>
                        @endcan
                        @can('create-role')
                            <li class="{{isActive('admin.roles.create','active')}}">
                                <a class="nav-link" href="{{route('admin.roles.create')}}">New Role</a>
                            </li>
                        @endcan
                    </ul>
                </li>

{{--            @endcanany--}}
        </ul>

    </aside>
</div>
