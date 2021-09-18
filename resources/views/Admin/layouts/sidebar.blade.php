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
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-coins"
                                                                                     style="font-size: 16px;"></i>
                    <span>Products</span></a>
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
            <li class="menu-header">Category panel</li>
            <li class="dropdown {{isActive('admin.categories.index','active')}} {{isActive('admin.categories.create','active')}} ">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-copyright"
                                                                                     style="font-size: 16px;"></i>
                    <span>Categories</span></a>
                <ul class="dropdown-menu">
                    @can('show-categories')
                        <li class="{{isActive('admin.categories.index','active')}}">
                            <a class="nav-link " href="{{route('admin.categories.index')}}">List Categories</a>
                        </li>
                    @endcan
                    @can('create-category')
                        <li class="{{isActive('admin.categories.create','active')}}">
                            <a class="nav-link" href="{{route('admin.categories.create')}}">New Category</a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="menu-header">Comments panel</li>
            <li class="dropdown {{isActive('admin.comments.index','active')}} {{isActive('admin.comments.unapproved','active')}}  ">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-comments"
                                                                                     style="font-size: 16px;"></i>
                    <span>Comments</span></a>
                <ul class="dropdown-menu">
                    @can('show-comments')
                        <li class="{{isActive('admin.comments.index','active')}}">
                            <a class="nav-link " href="{{route('admin.comments.index')}}">List Comments</a>
                        </li>
                    @endcan
                    @can('unapproved-comments')
                        <li class="{{isActive('admin.comments.unapproved','active')}}">
                            <a class="nav-link" href="{{route('admin.comments.unapproved')}}">Unapproved Comments</a>
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
            <li class="menu-header">Orders panel</li>
            <li class="dropdown {{isActive('admin.orders.index','active')}} {{isActive('admin.orders.create','active')}} ">
                <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
                <ul class="dropdown-menu">
                    <li class="{{isUrl(route('admin.orders.index',['type'=>'paid']),'active')}} nav-item">
                        <a class="nav-link " href="{{route('admin.orders.index',['type'=>'paid'])}}"><span class="left">Paid</span>  <small class="badge badge-primary right" style="border-radius: 4px">{{\App\Order::whereStatus('paid')->count()}} </small></a>
                    </li>
                    <li class="{{isUrl(route('admin.orders.index',['type'=>'unpaid']),'active')}} nav-item">
                        <a class="nav-link " href="{{route('admin.orders.index',['type'=>'unpaid'])}}"><span class="left">Unpaid</span> <small class="badge badge-warning right" style="border-radius: 4px"> {{\App\Order::whereStatus('unpaid')->count()}}  </small></a>
                    </li>
                    <li class="{{isUrl(route('admin.orders.index',['type'=>'canceled']),'active')}}">
                        <a class="nav-link " href="{{route('admin.orders.index',['type'=>'canceled'])}}"><span class="left">Canceled orders</span><small class="badge badge-danger right" style="border-radius: 4px"> {{\App\Order::whereStatus('canceled')->count()}}  </small></a>
                    </li>
                    <li class="{{isUrl(route('admin.orders.index',['type'=>'preparation']),'active')}}">
                        <a class="nav-link " href="{{route('admin.orders.index',['type'=>'preparation'])}}"><span class="left">Preparation orders</span><small class="badge badge-info right" style="border-radius: 4px">{{\App\Order::whereStatus('preparation')->count()}}  </small></a>
                    </li>
                    <li class="{{isUrl(route('admin.orders.index',['type'=>'posted']),'active')}}">
                        <a class="nav-link " href="{{route('admin.orders.index',['type'=>'posted'])}}"><span class="left">Posted orders</span><small class="badge badge-dark right" style="border-radius: 4px">{{\App\Order::whereStatus('posted')->count()}}  </small></a>
                    </li>
                    <li class="{{isUrl(route('admin.orders.index',['type'=>'received']),'active')}}">
                        <a class="nav-link " href="{{route('admin.orders.index',['type'=>'received'])}}"><span class="left">Received orders</span><small class="badge badge-success right " style="border-radius: 4px"> {{\App\Order::whereStatus('received')->count()}}  </small></a>
                    </li>

                </ul>
            </li>
        </ul>

    </aside>
</div>
