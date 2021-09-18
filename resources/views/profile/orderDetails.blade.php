@extends('profile.layoutProfile')

@section('profile')
    <div class="table-responsive">
        <table class="table table-striped v_center">
            <tbody>
            <tr>
                <th>Product Id</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            @foreach ($order->products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td class="text-center">{{$product->pivot->quantity}}</td>
                    <td class="text-center">{{$product->pivot->quantity * $product->pivot->price}} <small class="text-muted">$</small></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

