@extends('profile.layoutProfile')

@section('profile')
    {{--    <div class="container">--}}
    <div class="table-responsive">
        <table class="table table-striped v_center">
            <tbody>
            <tr>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Order status</th>
                <th>Amount</th>
                <th>Postal Tracking</th>
                <th>Actions</th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="{{route('profile.order.Details',$order->id)}}"
                           class="btn btn-sm btn-primary text-small text-white">
                            {{$order->id}}
                        </a>
                    </td>
                    <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans(['options' => 0])}}</td>
                    <td class="text-center">
                        <small
                            class="{{($order->status == 'paid') ?: 'badge badge-warning' }}">{{$order->status}}
                        </small>
                    </td>
                    <td>{{$order->price}} </td>
                    <td>{{$order->tracking_serial ?? 'Not registered yet'}}</td>
                    <td>
                        <a href="{{route('profile.order.Details',$order->id)}}"
                           class="btn btn-sm btn-primary text-small text-white">
                            Order Details
                        </a>
                        @if($order->status == 'unpaid')
                            <a href="{{route('profile.orders.payment',$order->id)}}"
                               class="btn btn-sm btn-primary text-small text-white">
                                Order Payment
                            </a>
                        @endif
                    </td>
                    {{--                    <td>--}}
                    {{--                        @can('delete-product')--}}
                    {{--                            <form action="{{route('admin.products.destroy',['product'=>$product->id])}}"--}}
                    {{--                                  method="POST" class="d-inline">--}}
                    {{--                                @csrf--}}
                    {{--                                @method('DELETE')--}}
                    {{--                                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>--}}
                    {{--                            </form>--}}
                    {{--                        @endcan--}}
                    {{--                        @can('edit-product')--}}
                    {{--                            <a href="{{route('admin.products.edit',[$product->id])}}"--}}
                    {{--                               class="btn btn-primary btn-sm">--}}
                    {{--                                Edit--}}
                    {{--                            </a>--}}
                    {{--                        @endcan--}}
                    {{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-center">
        {{ $orders->links() }}
    </div>
    {{--    </div>--}}
@endsection

