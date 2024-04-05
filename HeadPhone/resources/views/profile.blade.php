@extends('layouts.app')

@section('content')
<style>
    .card {
        display: flex;
        height: 100vh;
        /* Set chiều cao cho container */
        padding-right: 10px;
        padding-left: 20px;
    }

    .sidebar {
        width: 200px;
        /* Độ rộng của sidebar */
        background-color: #f0f0f0;
        /* Màu nền của sidebar */
        padding: 20px;
        /* Khoảng cách nội dung với lề */
    }

    .sidebar li {
        padding: 10px;
        border-bottom: 1px solid;
    }

    .sidebar ul {
        list-style-type: none;
        /* Loại bỏ dấu chấm tròn của list */
        padding: 0;
        /* Xóa padding mặc định của list */
    }

    .sidebar ul li a {
        display: block;
        /* Biến mỗi menu item thành một block element */
        text-decoration: none;
        /* Loại bỏ đường gạch chân của link */
        color: #333;
        /* Màu chữ của menu item */
        margin-bottom: 10px;
        /* Khoảng cách giữa các menu item */
    }

    .content {
        margin-left: 10px;
        flex: 1;
        /* Content area sẽ chiếm phần còn lại của container */
        padding: 20px;
        /* Khoảng cách nội dung với lề */
        background-color: #fff;
        /* Màu nền của content */
    }

    .avatar {
        border-radius: 30px;
        border: 1px solid red;
    }
</style>
<div class="card">
    <div class="sidebar">
        <ul>
            <li>
                <div>
                    <img class="avatar" src="{{asset('client/img/product02.png')}}" alt="" width="110">
                    <label style="margin-top: 10px;" for="">Nguyễn Văn Phúc</label>
                </div>
            </li>

            <li class="menu-item"><a href="#">Thông tin tài khoản</a></li>
            <li><a href="{{ route('profile.fetchAddress') }}">Địa chỉ nhận hàng</a></li>
            <li><a href="#">Đơn hàng</a></li>
            <li><a href="#">Mã giảm giá</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                  
                    <button type="submit">Đăng Xuất</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="content">
        @yield('content-profile')
    </div>
</div>

@endsection