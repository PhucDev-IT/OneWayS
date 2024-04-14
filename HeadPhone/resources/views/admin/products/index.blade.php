@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')
@section('content')
@include('admin/partials/modal_remove')

<style>
    .selected-page {
    font-weight: bold;
    color: blue; /* hoặc màu khác tùy bạn chọn */
    background-color: #8cfa99;
}

</style>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Danh sách sản phẩm đang kinh doanh</h4>
        <div>

            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm mới</a>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Nhập tên sản phẩm cần tìm" aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" onclick="search()" type="submit">Search</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-right">
                    <select class="form-control" name="category">
                        <option value="0" selected>Tất cả</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
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
                            Image
                        </th>
                        <th>
                            Tên Sản Phẩm
                        </th>
                        <th>
                            Đơn giá
                        </th>
                        <th>
                            Sale
                        </th>

                        <th>Rate</th>
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
    fetchData()

    function fetchData() {
        showLoadingPage();

        $.ajax({
            type: 'GET',
            url: "{{ route('admin.products') }}",
            dataType: "json",
            success: function(response) {
                hiddenLoadingPage();
                setData(response.products.data)
                customPaginate(response.products)
                
            }
        });

        
    }


    function setData(products) {
        $('tbody').empty();
        $.each(products, function(key, product) {
 
            $('tbody').append(`
                    <tr>
                        <td>
                            ${product.id}
                        </td>
                        <td>
                            <img src="{{asset('storage/uploads/${product.img_preview}')}}" alt="Demo" width="250">
                        </td>
                        <td>
                           ${product.name}
                        </td>
                        <td>
                            <span style="font-weight: 500; color: red;">${formatCurrency(product.price)} </span>
                        </td>
                        <td>
                    
                            <span class="text-danger">${product.sale}%</span>
                        </td>
                        <td>${product.rate}</td>
                        <td>
                            <a href="/admin/products/${product.id}/edit" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i></a>
                            <span id="btn-remove" onclick="showModelConfirm(this)" data-id="${product.id}"> <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></span>
                            <form action="" id="form-delete${product.id}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
    `);
        });
    }


    function getDataByPage(url,active) {
        console.log(url)
        if(url==='null' || active === true) return

        showLoadingPage();

        $.ajax({
            type: 'GET',
            url: url,
            dataType: "json",
            success: function(response) {
                hiddenLoadingPage();
                setData(response.products.data);
                customPaginate(response.products);
            }
        });
    }

    //Xóa sản phẩm
    function showModelConfirm(value){
        var id = $(value).data('id');
        document.getElementById('modal-body__text').innerHTML = 'Bạn có chắc muốn xóa sản phẩm này?';
        $('#confirmDeleteModal').data('itemid', id).modal('show');
    }

    $('#confirmDeleteButton').click(function() {
        var itemId = $('#confirmDeleteModal').data('itemid');
       
        $('#form-delete' + itemId).submit();

        $('#confirmDeleteModal').modal('hide');
    });


    //Tìm kiếm
    function search(){
         // Lấy giá trị của ô input
         var name = document.querySelector('input[name="search"]').value;
        
        // Lấy giá trị của select
        var category = document.querySelector('select[name="category"]').value;

        showLoadingPage();
        $.ajax({
            type: 'GET',
            url: '/api/products/search',
            data: {name,category},
            dataType: "json",
            success: function(response) {
                console.log(response)
                hiddenLoadingPage();
                setData(response.products.data);
                customPaginate(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    } 

</script>

@endsection