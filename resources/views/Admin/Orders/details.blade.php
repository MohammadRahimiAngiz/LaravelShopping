@component('Admin.layouts.content',['title' => 'List Order Details'])
    @slot('css')
    @endslot
    @slot('script')
        <script src="/js/admin/jquery-ui.min.js"></script>
        <script src="/js/admin/components-table.js"></script>
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.orders.index')."?type=$order->status&page=$pageOrder"}}">Order Number: {{$order->id}}</a></div>
            <div class="breadcrumb-item">details</div>
        </div>
    @endslot
    <p class="section-lead">This page is just list Order details.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped v_center">
                            <tbody>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Price ( $ )</th>
                                <th>Quantity</th>
                            </tr>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->price}}<small class="text-muted"> $</small></td>
                                    <td>{{$product->pivot->quantity}}</td>
{{--                                    <td>{{\Carbon\Carbon::parse($payment->created_at)->diffForHumans(['options' => 0])}}</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    {{ $products->links() }}
                    {{--                    {{ $orders->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@endcomponent
