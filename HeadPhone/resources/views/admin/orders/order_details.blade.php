@extends('admin.layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="{{asset('admin/assets/css/order.css')}}">
</head>
<div class="card-order">
    <div class="tracking">
        <div class="left-header">
            <span class="left-header title">Tiến trình</span>
            <span>{{ $order->trackingOrders->last()->name }}</span>

        </div>
        <div class="tracking-content">
            <div class="rightbox">
                <div class="rb-container" style="overflow: auto;">
                    <ul class="rb">
                        @foreach($order->trackingOrders as $tracking)
                        <li class="rb-item" ng-repeat="itembx">
                            <div class="timestamp">
                                {{$tracking->name_vn}}<br> <span>{{$tracking->time}}</span>
                            </div>
                            <div class="item-title">{{$tracking->description}}</div>

                        </li>
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </div>


    <div class="card-content">
        <div class="content-header">
            <div class="tracking-number">
                <label>Order number</label>
                <span style="color: #31B6C0;">#{{$order->order_id}}</span>
            </div>

            <div class="order-create">
                <label>Created</label>
                <span>{{$order->created_at}}</span>

            </div>
            <div class="order-create">
                @if($order->trackingOrders->last()->name == "PENDING")
                <a href="{{route('orders.confirm_order',['idOrder' => $order->order_id])}}" class="btn btn-primary">Xác nhận</a>
                @elseif($order->trackingOrders->last()->name == "PROCESSING")
                <a href="{{route('orders.delivering',['idOrder' => $order->order_id])}}" class="btn btn-primary">Giao hàng</a>
                @elseif($order->trackingOrders->last()->name == "DELIVERING")
                <a href="{{route('orders.shipped',['idOrder' => $order->order_id])}}" class="btn btn-primary">Đã giao</a>
                @endif
            </div>
        </div>

        <div class="order contact">
            <p style="font-weight: bold; font-size: 20px;">Thông tin nhận hàng</p>
            <!-- Thông tin user -->
            <div class="contact-content">
                <div class="contact-information">
                    <img src="{{$order->user->avatar}}" alt="" width="50">
                    <div class="contact-user">
                        <div><i class="fa-regular fa-user" style="color: #B197FC;"></i>{{$order->user->name}}</div>
                        <div> <i class="fa-regular fa-envelope" style="color: #B197FC;"></i> {{$order->user->email}}</div>
                    </div>
                </div>
                <div class="address">
                    <div style="font-weight: 600;"><i class="fa-solid fa-location-dot" style="color: #3314cc;"></i> Ship to</div>
                    <div class="details" style="margin-left: 10px;">
                        <span>{{$order->address->name}}</span>
                        <span>{{$order->address->phone}}</span>
                        <span>{{$order->address->ward_name}}, {{$order->address->district_name}}, {{$order->address->province_name}}</span>
                        <span>{{$order->address->details}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="order order-information">
            <p style="font-weight: bold; font-size: 20px;">Thông tin hóa đơn</p>
            <div>
                <span></span>
            </div>
        </div>

        <div class="order">
           @foreach($orderDetails as $item)
           <div class="product-item">
           <img src="{{ asset('storage/uploads/'.$item->product->img_preview) }}" alt="" />
                <div class="information">
                    <label for="">{{$item->product->name}}</label>
                    <div>
                        <span class="title">Phân loại:</span>
                        <span class="detail">{{$item->color}}</span>
                    </div>
                    <div>
                        <span>x{{$item->quantity}}</span>
                    </div>
                    <div><span style="color: red;">     {{ number_format($item->price, 0, ',', '.') }} đ</span></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    hiddenLoadingPage();
</script>

@endsection