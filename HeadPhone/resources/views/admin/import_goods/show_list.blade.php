@extends('admin.layouts.app')

@section('title', 'Nhập hàng')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin sản phẩm đã nhập</h4>
        <div><a href="" class="btn btn-primary">Thêm mới</a></div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Mã sản phẩm
                        </th>
                        <th>
                            Tên sản phẩm
                        </th>
                        <th>Phân loại</th>
                        <th>
                            Số lượng
                        </th>
                        <th>
                            Giá bán
                        </th>
                        <th>Trạng thái</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->product_id != null)
                            {{$product->product_id }}
                            @else
                            <span style="background-color: #d136d9; padding: 3px;">Sản phẩm mới</span>
                            @endif

                        <td>{{$product->name}}</td>
                        <td>{{$product->color}}</td>
                        <td>{{$product->quantity}}</td>
                        <td><span style="font-weight: 500; color: red;">{{ number_format($product->price, 0, ',', '.') }}đ</span></td>
                        <td>
                            @if($product->is_import==true)
                            <span style="color: red; font-weight: 600;">Đã nhập số lượng</span>
                            @else
                            <span style="color: green; font-weight: 600;">Chưa đồng bộ số lượng</span>
                            @endif

                        <td>
                            @if($product->product_id!=null && $product->is_import == false)
                            <a class="edit" data-product_id="{{$product->product_id}}" data-id="{{$product->id}}" onclick="return searchProduct(this);" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <i class="typcn typcn-input-checked-outline"></i>
                                Đồng bộ
                            </a>

                            @endif
                            <a style="margin-left: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i> Sửa</a>
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





<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">ĐỒNG BỘ SẢN PHẨM</h3>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{route('admin.sync-product')}}">
                @csrf
                <div class="modal-body">

                    <input type="text" name="import_infor_id" hidden value="{{$import_id}}">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Thông tin sản phẩm:</label>
                        <div>
                            <img id="img-product" src="" alt="" width="50">
                            <span id="modal-name-product"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" id="input-import_product" name="import_product_id" hidden>
                        <label for="message-text" class="col-form-label">Màu sắc:</label>
                        <select style="width: 100%; height: 30px;" name="color_id" id="product-color">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Đồng bộ</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    hiddenLoadingPage();

    function searchProduct(value) {
        var product_id = value.getAttribute('data-product_id');
        var import_product_id = value.getAttribute('data-id');
        console.log(product_id);
        $.ajax({
            type: 'get',
            url: '/api/admin/find-product',
            data: {
                product_id: product_id
            },
            dataType: 'json',
            success: function(product) {
                console.log(product);
                $('#modal-name-product').text(product.name);
                $('#img-product').attr('src', `{{ asset('storage/uploads/') }}/${product.img_preview}`);
                $('#input-import_product').val(import_product_id);
                $.each(product.details, function(i, color) {
                    renderOption(color);
                });
            },

            error: function(xhr, err) {
                console.log(err);
            }
        });
    }

    function renderOption(color) {
        html = `
        <option value="${color.id}">${color.color}</option>
        `;
        $('#product-color').append(html);
    }
</script>

@endsection