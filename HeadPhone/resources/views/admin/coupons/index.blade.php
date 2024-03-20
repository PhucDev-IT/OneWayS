@extends('admin.layouts.app')

@section('title', 'Users')
@section('content')
@include('admin/partials/modal_remove')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tất cả voucher hiện có</h4>
        <div><a href="{{route('vouchers.create')}}" class="btn btn-primary">Thêm mới</a></div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Mã voucher
                        </th>
                        <th>
                            Tiêu đề
                        </th>
                        <th>
                            Giảm giá
                        </th>
                        <th>
                            Số lượng
                        </th>
                        <th>
                            Đã dùng
                        </th>
                    
                        <th>
                            Bắt đầu
                        </th>
                        <th>
                            Kết thúc
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                 
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
    fetchData();
    //Lấy dữ liệu từ serve
    function fetchData(){
        $.ajax({
            type: 'GET',
            url: '/api/fetch-coupons',
            dataType: 'json',
            success: function(response){
                console.log(response);
                hiddenLoadingPage();
                $('tbody').empty();
                $.each(response.vouchers.data,function(key,voucher){
                    setData(voucher);
                })
                customPaginate(response.vouchers)

            }, error: function(error) {
                    console.log(error);
                }
        });
    }

    function setData(voucher){
        var discount = ""
        if(voucher.type == "FreeShip"){
            discount = "Miễn phí vận chuyển"
        }else if(voucher.type == "DISCOUNTMONEY"){
            discount = formatCurrency(voucher.discount)
        }else{
            discount = voucher.discount + '%'
        }
        $('tbody').append(`
        <tr>
                        <td>
                        ${voucher.voucher_id}
                        </td>
                        <td>
                            ${voucher.name}
                        </td>
                        <td>
                           ${discount}
                        </td>
                        <td>${voucher.quantity}</td>
                        <td>${voucher.used}</td>
                    
                        <td>${voucher.start_time}</td>
                        <td>${voucher.end_time}</td>
                        <td>
                        <a href="/admin/vouchers/${voucher.voucher_id}/edit" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i></a>
                            <span id="btn-remove" onclick="showModelConfirm(this)" data-id="${voucher.voucher_id}"> <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></span>
                        </td>
                      
                    </tr>
        `);
    }

    function getDataByPage(url,active) {
   
        if(url==='null' || active === true) return

        showLoadingPage();

        $.ajax({
            type: 'GET',
            url: url,
            dataType: "json",
            success: function(response) {
                hiddenLoadingPage();
                $('tbody').empty();
                $.each(response.vouchers.data,function(key,voucher){
                    setData(voucher);
                })
                customPaginate(response.vouchers);
            }
        });
    }

        //Xóa voucher
        function showModelConfirm(value){
        var id = $(value).data('id');
        document.getElementById('modal-body__text').innerHTML = 'Bạn có chắc muốn xóa mã giảm giá này?';
        $('#confirmDeleteModal').data('itemid', id).modal('show');
    }

    $('#confirmDeleteButton').click(function() {
        var itemId = $('#confirmDeleteModal').data('itemid');
       
        $('#form-delete' + itemId).submit();

        $('#confirmDeleteModal').modal('hide');
    });


</script>

@endsection