@component('Admin.layouts.content',['title'=>'Edit Order:' ])
    @slot('css')
    @endslot
    @slot('script')
    @endslot
    @slot('breadcrumb')
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{route('admin.orders.index')}}">Orders</a></div>
            <div class="breadcrumb-item">Edit Order</div>
        </div>
    @endslot
    <p class="section-lead">Order number: {{$order->id}}</p>
    <div class="col-12 col-lg-6 col-md-6 p-0">
        <div class="card">
            <form action="{{route('admin.orders.update',[$order->id])}}" method="POST">
                @csrf
                @method('PATCH')
                {{--                <div class="card-header">--}}
                {{--                    <h4>Server-side Validation</h4>--}}
                {{--                </div>--}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="OrderNumber">Order number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                            <input id="OrderNumber" name="OrderNumber" type="text" class="form-control"
                                   value="{{ $order->id }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Order cost</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-dollar">$</i>
                                </div>
                            </div>
                            <input id="price" name="price" type="text" class="form-control" value="{{ $order->price }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Order status</label>
                        <div>
                            <select id="status" name="status" class="custom-select @error('status') is-invalid @enderror" required="required">
                                <option value="paid" {{$order->status == 'paid' ? 'selected' : ''}}>paid</option>
                                <option value="unpaid" {{$order->status == 'unpaid' ? 'selected' : ''}}>Unpaid</option>
                                <option value="preparation" {{$order->status == 'preparation' ? 'selected' : ''}}>preparation</option>
                                <option value="posted" {{$order->status == 'posted' ? 'selected' : ''}}>posted</option>
                                <option value="received" {{$order->status == 'received' ? 'selected' : ''}}>received</option>
                                <option value="canceled" {{$order->status == 'canceled' ? 'selected' : ''}}>canceled</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="trackingSerial">Tracking Serial</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-paper-plane"></i>
                                </div>
                            </div>
                            <input value="{{old('trackingSerial',$order->tracking_serial)}}" id="trackingSerial"
                                   class="form-control  @error('trackingSerial') is-invalid @enderror" name="trackingSerial" type="text" >
                            @error('trackingSerial')
                            <div class="alert alert-danger p-2 ml-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary"><i class="fas fa-user-edit mr-1"></i>Save Edit Order</button>
                    <a href="{{route('admin.orders.index',['type'=> $order->status])}}" class="btn btn-secondary"><i
                            class="fas fa-undo mr-1"></i>Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endcomponent
