@extends('admin.layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="{{asset('admin/assets/css/order.css')}}">
</head>
<div class="card-order">
    <div class="card left">
        <div class="left-header">
            <span class="left-header title">Order status</span>
            <span>Delivery</span>
        </div>
    </div>

    <div class="card-content">
        <div class="content-header">
            <div class="tracking-number">
                <label>Tracking number</label>
                <span style="color: #31B6C0;">#08GSDGSS325</span>
            </div>

            <div class="order_id">
                <label>Order ID</label>
                <div>
                    <span>2352532</span>

                </div>
            </div>
            <div class="order-create">
                <label>Created</label>
                <span>12/12/2034</span>

            </div>
        </div>

        <div class="order contact">
            <p style="font-weight: bold; font-size: 20px;">Contact Details</p>
            <!-- Thông tin user -->
            <div class="contact-content">
            <div class="contact-information">
                <img src="{{asset('storage/uploads/1709816330_head1_1.jpg')}}" alt="" width="50">
                <div class="contact-user">
                    <div><i class="fa-regular fa-user" style="color: #B197FC;"></i>Nguyễn Văn Phúc</div>
                    <div> <i class="fa-regular fa-envelope" style="color: #B197FC;"></i> nguyenvanphuc3603@gmail.com</div>
                </div>
            </div>
            <div class="address">
                <div style="font-weight: 600;"><i class="fa-solid fa-location-dot" style="color: #3314cc;"></i> Ship to</div>
                <div class="details" style="margin-left: 10px;">
                    <span>Nguyễn Văn Phúc</span>
                    <span>0374164756</span>
                    <span>Thôn kiều tiến, xã hoằng đại, thành phố thanh hóa</span>
                </div>
            </div>
            </div>
        </div>

        <div class="order order-information">
        <p style="font-weight: bold; font-size: 20px;">Information</p>
        <div>
            <span></span>
        </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    hiddenLoadingPage();
</script>

@endsection