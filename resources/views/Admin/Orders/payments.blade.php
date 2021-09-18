@component('Admin.layouts.content',['title' => 'List Order Payments'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.orders.show',$order->id)}}">Order Number: {{$order->id}}</a></div>
            <div class="breadcrumb-item">payments</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list Order payments.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-header-form">
{{--                        <form>--}}
{{--                            @csrf--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="hidden" class="form-control" name="type" value="{{request('type')}}"--}}
{{--                                       placeholder="type">--}}
{{--                                <input type="text" class="form-control" name="search" value="{{request('search')}}"--}}
{{--                                       placeholder="Search">--}}
{{--                                <div class="input-group-btn">--}}
{{--                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped v_center">
                            <tbody>
                            <tr>
{{--                                <th>--}}
{{--                                    <div class="custom-checkbox custom-control">--}}
{{--                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"--}}
{{--                                               class="custom-control-input" id="checkbox-all">--}}
{{--                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>--}}
{{--                                    </div>--}}
{{--                                </th>--}}
                                <th>Payment ID</th>
                                <th>Payment Number</th>
                                <th>Payment Status</th>
                                <th>Payment roll time</th>
                            </tr>
                            @foreach ($payments as $payment)
                                <tr>
{{--                                    <td class="">--}}
{{--                                        <div class="custom-checkbox custom-control">--}}
{{--                                            <input type="checkbox" data-checkboxes="mygroup"--}}
{{--                                                   class="custom-control-input" id="{{'checkbox'.$order->id}}">--}}
{{--                                            <label for="{{'checkbox'.$order->id}}"--}}
{{--                                                   class="custom-control-label">&nbsp;</label>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->resNumber}}</td>
                                    <td>{{$payment->status ? 'Paid' : 'Unpaid'}}</td>
                                    <td>{{\Carbon\Carbon::parse($payment->created_at)->diffForHumans(['options' => 0])}}</td>
{{--                                    <td>--}}
{{--                                        <div class="btn-group  btn-group-sm ">--}}
{{--                                            @can('show-order')--}}
{{--                                                <a href="{{route('admin.orders.show',$order->id)}}"--}}
{{--                                                   class="btn btn-primary btn-sm pt-1">View details</a>--}}
{{--                                                <a href="{{route('admin.orders.payments',$order->id)}}"--}}
{{--                                                   class="btn btn-info btn-sm pt-1">View payments</a>--}}
{{--                                            @endcan--}}

{{--                                            @can('edit-order')--}}
{{--                                                <a href="{{route('admin.orders.edit',$order->id)}}"--}}
{{--                                                   class="btn btn-warning btn-sm pt-1">Edit order</a>--}}
{{--                                            @endcan--}}
{{--                                            @can('delete-order')--}}
{{--                                                <form--}}
{{--                                                    action="{{route('admin.orders.destroy',$order->id)}}"--}}
{{--                                                    method="POST"--}}
{{--                                                    class="d-inline">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit" class="btn btn-danger btn-sm pt-1">--}}
{{--                                                        Delete order--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}

{{--                                            @endcan--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $payments->links() }}
                    {{--                    {{ $orders->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@endcomponent
