@extends('admin.layouts.app')
@section('title', 'Chi tiết hóa đơn')
@section('content')

<style>
    .row {
        margin-bottom: 4px;
    }
</style>

<head>
    <link rel="stylesheet" href="{{asset('admin/assets/css/order.css')}}">
</head>
<div class="card-order">
    <div class="tracking">
        <div class="left-header">
            <span class="left-header title">Tiến trình</span>
            <span style="background-color: #f5cb4e; padding: 5px; border-radius: 5px; font-weight: 600;">{{ $order->trackingOrders->last()->name }}</span>

        </div>
        <div class="tracking-content">
            <div class="rightbox">
                <div class="rb-container">
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Hủy đơn hàng</button>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">Mã đơn hàng</div>
                        <div class="col-6"><span style="color: #31B6C0;">#{{$order->order_id}}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-6">Thời gian đặt</div>
                        <div class="col-6">{{$order->created_at}} </div>
                    </div>
                    <div class="row">
                        <div class="col-6">Phương thức thanh toán</div>
                        <div class="col-6">{{$order->method_payment}}</div>
                    </div>
                    <div class="row">
                        <div class="col-6">Tổng tiền</div>
                        <div class="col-6"> {{ number_format($order->total, 0, ',', '.') }} đ</div>
                    </div>
                    <div class="row">
                        <div class="col-6">Phí vận chuyển</div>
                        <div class="col-6"> {{ number_format($order->feeship, 0, ',', '.') }} đ</div>
                    </div>
                    <div class="row">
                        <div class="col-6">Giảm giá</div>
                        <div class="col-6">
                            <?php
                            $voucher = $order->voucher()
                            ?>
                            @if($voucher != null)
                            {{ number_format(($voucher->type == 'FREESHIP') ? $order->feeship : $voucher->discount, 0, ',', '.') }} đ
                            @else
                            {{ number_format(0, 0, ',', '.') }} đ
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6" style="font-weight: bold; font-size: 18px;">Tổng thanh toán</div>
                        <div class="col-6"> <span style="font-weight: bold; font-size: 18px; color: red;">{{ number_format($order->totalmoney, 0, ',', '.') }} đ</span></div>
                    </div>

                </div>
                <div class="col-md-6">
                    @if($voucher!=null)
                    <div class="row">
                        <div class="col-6 text-right">Mã voucher</div>
                        <div class="col-6 text-right"><a style="color: #c42eff;">#{{$voucher->voucher_id}}</a></div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-right">Loại voucher</div>
                        <div class="col-6 text-right"><span>{{$voucher->name}}</span></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="order">
            @foreach($orderDetails as $item)
            <div class="product-item">
                <img src="{{ asset('storage/uploads/'.$item->product->img_preview) }}" alt="" />
                <div class="information">
                    
                    <label for=""><a href="{{route('products.show_details',['id'=>$item->product->id])}}">{{$item->product->name}}</a></label>
                    <div>
                        <span class="title">Phân loại:</span>
                        <span class="detail">{{$item->color}}</span>
                    </div>
                    <div>
                        <span>x{{$item->quantity}}</span>
                    </div>
                    <div><span style="color: red;"> {{ number_format($item->price, 0, ',', '.') }} đ</span></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Bạn muốn hủy đơn hàng?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('admin.orders.cancel')}}">
                @csrf
                <div class="modal-body">
                    <input type="text" name="order_id" value="{{$order->order_id}}" hidden>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Vui lòng cho chúng tôi biết lý do của bạn</label>
                        <textarea class="form-control" id="message-text" name="reason" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
@section('script')
<script>
    hiddenLoadingPage();
</script>

@endsection