@component('Admin.layouts.content',['title' => 'List Orders'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item">Orders</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list Orders.</p>
    <h3 class="text-center p-2 " style="background-color: {{$backgroundColor}};border-radius: 15px;border:1px solid #ffffff;">{{request('type')}}</h3>
    <div class="row">
        <div class="col-12">
            <div class="card" style="background-color: {{$backgroundColor}};border-radius: 20px;">
                <div class="card-header">
                    <div class="card-header-form">
                        <form>
                            @csrf
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="type" value="{{request('type')}}"
                                       placeholder="type">
                                <input type="text" class="form-control" name="search" value="{{request('search')}}"
                                       placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0 ">
                    <div class="table-responsive">
                        <table class="table table-striped v_center">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Order amount<small class="text-muted ml-1">( $ )</small></th>
                                <th>Order status</th>
                                <th>Postal tracking number</th>
                                <th>Order registration time</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->email}}</td>
                                    <td>{{$order->price}} <small class="text-muted ml-1"> $ </small></td>
                                    <td>{{$order->status}}</td>
                                    <td>@if(!$order->tracking_serial)
                                            Not registered yet
                                        @else
                                            {{$order->tracking_serial}}
                                        @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans(['options' => 0])}}</td>
                                    <td>
                                        <div class="btn-group  btn-group-sm ">
                                            @can('show-order')
                                                <a href="{{route('admin.orders.show',$order->id)."?pageCurrent=".request('page')}}"
                                                   class="btn btn-primary btn-sm pt-1">View details</a>
                                                <a href="{{route('admin.orders.payments',$order->id)}}"
                                                   class="btn btn-info btn-sm pt-1">View payments</a>
                                            @endcan

                                            @can('edit-order')
                                                <a href="{{route('admin.orders.edit',$order->id)}}"
                                                   class="btn btn-warning btn-sm pt-1">Edit order</a>
                                            @endcan
                                            @can('delete-order')
                                                <form
                                                    action="{{route('admin.orders.destroy',$order->id)}}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm pt-1">
                                                        Delete order
                                                    </button>
                                                </form>

                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $orders->appends(['type'=>request('type')])->links() }}
                    {{--                    {{ $orders->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@endcomponent
