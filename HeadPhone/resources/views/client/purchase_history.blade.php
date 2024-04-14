@extends('profile')
@section('title', 'Quản lý hóa đơn')
@section('content-profile')


<style>
    .selected-page {
        font-weight: bold;
        color: blue;
        /* hoặc màu khác tùy bạn chọn */
        background-color: #8cfa99;
    }

    .card-body {
        width: 100%;
    }
</style>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Lịch sử mua hàng</h4>
        <div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                </div>

                <form action="/orders" id="selected-status" method="get">
                    <div class="col-md-3 text-right">
                        <select class="form-control" name="status" id="status-select">
                            <option value="PENDING" selected>Chờ xác nhận</option>
                            <option value="PROCESSING">Đang giao hàng</option>
                            <option value="SHIPPED">Đã mua</option>
                            <option value="CANCEL">Đơn đã hủy</option>
                        </select>
                    </div>
                </form>
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
                        <td>#{{$order->order_id}}</td>
                        <td>{{$order->details()->count()}} sản phẩm</td>
                        <td>{{$order->orderdate}}</td>
                        <td>{{$order->current_status}}</td>
                        <td>{{ number_format($order->totalmoney, 0, ',', '.') }} đ</td>
                        <td>
                            <a href="/order/tracking/{{$order->order_id}}" class="view" title="Xem" data-toggle="tooltip" style="color: #ff0000;"><i class="material-icons" style="color: violet;">&#xe8f4;</i></a>
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
 
 document.getElementById('status-select').addEventListener('change', function() {
        document.getElementById('selected-status').submit();
    });

</script>


@endsection
