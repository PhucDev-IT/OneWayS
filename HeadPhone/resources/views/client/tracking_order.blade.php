@extends('profile')
@section('title', 'Theo dõi đơn hàng')
@section('content-profile')

<style>
    .row {
        margin-bottom: 4px;
    }
</style>

<head>
    <link rel="stylesheet" href="{{asset('client/css/customs/order.css')}}">
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
        <div class="cart-item card-header">
            <div class="tracking-number">
                <label>Order number</label>
                <span style="color: #31B6C0;">#{{$order->order_id}}</span>
            </div>

            <div class="order-create">
                <label>Created</label>
                <span>{{$order->created_at}}</span>

            </div>
            <div class="">
                @if($order->trackingOrders->last()->name == "PENDING")
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Hủy đơn hàng</button>
                @elseif($order->trackingOrders->last()->name == "SHIPPED" && $order->review()->count() <= 0) <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-review">Đánh giá</button>
                    @endif
            </div>
        </div>

        <div class="order card-contact">
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

        <div class="order ">
            <p style="font-weight: bold; font-size: 20px;">Thông tin hóa đơn</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">Mã đơn hàng</div>
                        <div class="col-md-6"><span style="color: #31B6C0;">#{{$order->order_id}}</span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Thời gian đặt</div>
                        <div class="col-md-6">{{$order->created_at}} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Phương thức thanh toán</div>
                        <div class="col-md-6">{{$order->method_payment}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Tổng tiền</div>
                        <div class="col-md-6"> {{ number_format($order->total, 0, ',', '.') }} đ</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Phí vận chuyển</div>
                        <div class="col-md-6"> {{ number_format($order->feeship, 0, ',', '.') }} đ</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Giảm giá</div>
                        <div class="col-md-6">
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
                        <div class="col-md-6" style="font-weight: bold; font-size: 18px;">Tổng thanh toán</div>
                        <div class="col-md-6"> <span style="font-weight: bold; font-size: 18px; color: red;">{{ number_format($order->totalmoney, 0, ',', '.') }} đ</span></div>
                    </div>

                </div>
                <div class="col-md-6">
                    @if($voucher!=null)
                    <div class="row">
                        <div class="col-md-6 text-right">Mã voucher</div>
                        <div class="col-md-6 text-right"><a style="color: #c42eff;">#{{$voucher->voucher_id}}</a></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-right">Loại voucher</div>
                        <div class="col-md-6 text-right"><span>{{$voucher->name}}</span></div>
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

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="/order/cancel">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận hủy đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Thật đáng tiếc, vui lòng cho chúng tôi biết lý do của bạn?
                    <textarea class="form-control" id="message-text" name="reason" required></textarea>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal đánh giá sản phẩm -->
<div class="modal fade" id="modal-review">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Đánh giá sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="{{route('order.reviews')}}" method="post" class="review-form">
                @csrf
                <div class="modal-body">
                    <label for="">Chọn sản phẩm đánh giá</label>
                    <br>
                    <?php
                    $index = 0;
                    $products = [];
                    $first_id = "";
                    foreach ($orderDetails as $item) {
                        $productId = $item->product->id;
                        $color = $item->color;

                       if($index++ == 0){
                        $first_id = $productId;
                       }
                       

                        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách hay chưa
                        if (array_key_exists($productId, $products)) {
                            // Nếu sản phẩm đã tồn tại, thêm màu vào danh sách color của sản phẩm
                            $products[$productId]['color'] .= ", " . $color;
                        } else {
                            // Nếu sản phẩm chưa tồn tại, thêm mới vào danh sách
                            $products[$productId] = [
                                'id' => $productId,
                                'name' => $item->product->name,
                                'color' => $color  // Sử dụng mảng để lưu trữ danh sách color
                            ];
                        }
                    }
                    ?>

                    <select style="height: 30px; margin-bottom: 10px;" name="product_id" id="dropdown">
                        @foreach($products as $productId => $product)
                        <option value="{{$productId}}">{{$product['name']}} - {{$product['color']}}</option>
                        @endforeach
                    </select>

                    <input type="text" hidden name="title" id="classify_product" value="{{$products[$first_id]['name']}} - {{$products[$first_id]['color']}}">

                    <div id="review-form">
                        <input type="text" hidden value="{{$order->order_id}}" name="order_id">
                        <label for="">Vui lòng cho chúng tôi biết trải nghiệm sản phẩm của bạn</label>
                        <textarea name="comment" class="input" placeholder="Your Review" required></textarea>
                        <div class="input-rating">
                            <span>Your Rating: </span>
                            <div class="stars">
                                <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" onclick="return validateForm()" class="btn btn-primary">Đánh giá</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    function validateForm() {
        var ratingSelected = document.querySelector('input[name="rating"]:checked');
        if (!ratingSelected) {
            alert("Vui lòng chọn rating trước khi đánh giá.");
            return false;
        }
        return true;
    }

    // Lắng nghe sự kiện DOMContentLoaded để đảm bảo rằng toàn bộ trang đã được tải xong
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy ra dropdown và input hidden
        var dropdown = document.getElementById("dropdown");
        var hiddenInput = document.getElementById("classify_product");

        // Lấy ra giá trị của option đầu tiên trong dropdown
        var defaultValue = dropdown.options[0].innerText;
        console.log(defaultValue);
        // Gán giá trị mặc định cho input hidden
        hiddenInput.value = defaultValue;
    });


    document.getElementById("dropdown").addEventListener("change", function() {
        // Lấy ra giá trị của option được chọn
        var selectedValue = this.value;
        // Lấy ra text của option được chọn
        var selectedText = this.options[this.selectedIndex].innerText;

        $('#classify_product').val(selectedText);
        // Hiển thị text của option được chọn trong console
        console.log(selectedText);
    });
</script>

@endsection