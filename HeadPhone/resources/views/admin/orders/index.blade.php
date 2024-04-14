@extends('admin.layouts.app')

@section('title', 'Quản lý hóa đơn')
@section('content')
@include('admin/partials/modal_remove')

<style>
    .selected-page {
        font-weight: bold;
        color: blue;
        /* hoặc màu khác tùy bạn chọn */
        background-color: #8cfa99;
    }
</style>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Danh sách hóa đơn đang chờ xác nhận</h4>
        <div>

            <div class="row">
                <div class="col-md-3">

                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Mã hóa đơn cần tìm" aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" onclick="search()" type="submit">Search</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-right">
                    <form action="{{route('orders.index')}}" method="get" id="selected-status">
                        <select class="form-control" name="tracking" id="status-select">
                            <option value="pending" selected>Chờ xác nhận</option>
                            <option value="processing">Đang đóng hàng</option>
                            <option value="delivering">Đang giao hàng</option>
                            <option value="shipped">Đã giao hàng</option>
                            <option value="cancel">Đơn hàng đã hủy</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Sản phẩm
                        </th>
                        <th>
                            Khách hàng
                        </th>
                        <th>
                            Ngày đặt
                        </th>
                        <th>
                            Trạng thái
                        </th>

                        <th>Đơn giá</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            {{$order->order_id}}
                        </td>

                        <td>{{$order->details->count()}} sản phẩm</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->orderdate}}</td>
                        <td>{{$order->current_status}}</td>
                        <td><span style="font-weight: 500; color: red;">{{ number_format($order->totalmoney, 0, ',', '.') }}đ</span></td>
                        <td>
                            
                             <a href="/admin/order/id={{$order->order_id}}"><i class="fa-regular fa-eye" style="margin-right: 10px;"></i>Xem chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="pagination_contain" aria-label="Page navigation example" style="margin-top: 10px;">
                <ul class="pagination">

                </ul>
            </nav>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    hiddenLoadingPage();

    document.getElementById('status-select').addEventListener('change', function() {
        document.getElementById('selected-status').submit();
    });


    function fetchData() {
        $.ajax({
            type: 'GET',
            url: "/admin/fetch/orders",
            dataType: 'json',
            success: function(response) {
                console.log(response);
                setData(response.orders);
            },
            error: function(err) {
                console.log(err);
            }
        });

        function setData($orders) {
            $('tbody').empty();
            $.each($orders, function(key, order) {

                $('tbody').append(`
            <tr>
                        <td>
                            ${order.order_id}
                        </td>
                        <td>
                           
                        </td>
                        <td>
                            ${order.user.name}
                        </td>
                        <td>
                             ${order.orderdate}   
                        </td>
                        <td>
                    
                            <span class="text-danger"> ${order.current_status} </span>
                        </td>
                        <td><span class="text-danger">${formatCurrency(order.totalmoney)} </span></td>
                        <td>
                            <a href="/admin/order/id=${order.order_id}" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i></a>
                            <span id="btn-remove" onclick="showModelConfirm(this)" data-id=""> <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></span>
                            
                        </td>
                    </tr>
            `);
            });
        }

    }
</script>
@endsection