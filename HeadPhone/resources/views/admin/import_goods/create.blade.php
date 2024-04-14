@extends('admin.layouts.app')

@section('title', 'Tạo phiếu nhập')
@section('content')


<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm mới phiếu nhập</h4>
        <form action="{{route('imports.store')}}" method="post" class="forms-sample">
            @csrf
            <div class="form-group">
                <label>Thời gian nhập</label>
                <input name="time" type="date" value="{{old('time')}}" class="form-control" placeholder="dd/MM/yyyy">
                @error('time')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tổng tiền nhập</label>
                <input name="total" type="number" value="{{old('total')}}" class="form-control" placeholder="Tổng tiền nhập hàng" readonly>
                @error('total')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                <label for="exampleFormControlSelect2">Hãng cung cấp</label>
                <select name="supplier_id" class="form-control" id="exampleFormControlSelect2">
                    @foreach($suppliers as $supplier)
                    <option selected value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
                </select>

                @error('supplier_id')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tên sản phẩm</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="hidden" id="input-products" name='products'>
                    <input id="input-product"  type="text" class="form-control" placeholder="Nhập tên sản phẩm">
                </div>
                <!-- Container để hiển thị gợi ý -->
                <div id="productSuggestions">

                </div>
            </div>
            <div class="row">
            <div class="col">
                    <div class="form-group">
                        <label>Màu sắc</label>
                        <input id="input-color"  type="text" class="form-control " placeholder="Màu sản phẩm">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input id="input-quantity"  type="number" class="form-control " min="1" placeholder="Số lượng">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Giá nhập</label>
                        <input id="input-price" type="number" class="form-control " min="1" placeholder="Đơn giá">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <div><label for=""> .</label></div>
                        <div> <i id="btn-add-product" style="font-size: 35px; color: green;" class="material-icons">&#xe147;</i></div>

                    </div>
                </div>
            </div>
            <div id="products-body">

            </div>

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>


@endsection

@section('script')

<script>
    let products = [];
    let selectProduct = null

    hiddenLoadingPage();

    let shouldDisplayResults = true; // Biến để kiểm tra xem có nên hiển thị kết quả tìm kiếm không


    const processChange = debounce(() => {
        if (shouldDisplayResults) { // Kiểm tra điều kiện trước khi thực hiện tìm kiếm
            loadProducts();
        }
    });


    function loadProducts() {
        var query = document.getElementById('input-product').value;

        // Gọi Ajax để tìm kiếm người dùng
        $.ajax({
            url: "{{route('admin.products.filler')}}",
            method: 'GET',
            data: {
                query: query
            },
            success: function(response) {
                console.log(response)
                displaySuggestions(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    }

    // Hàm hiển thị gợi ý người dùng
    function displaySuggestions(products) {
        $("#productSuggestions").empty();
        selectProduct = null;
     
        if (products.length > 0) {

            let list = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%" >';
            products.forEach(function(product) {
                list += `<li data-id="${product.id}" data-name = "${product.name}" >
                <span class="dropdown-item" style="color:orange; font-size:14px">
                    <img src="{{asset('storage/uploads/${product.img_preview}')}}" alt="Demo" width="30"> ${product.name} 
                </span>
                 </li>`;
            });
            list += '</ul>';

            $("#productSuggestions").append(list);
            $('#productSuggestions').fadeIn(); // Hiển thị danh sách gợi ý
        }
    }
    $('#input-product').keyup(function() {
        shouldDisplayResults = true; // Bật cờ hiển thị kết quả tìm kiếm
        processChange(); // Gọi debounce function
    });


    $(document).on('click', '#productSuggestions li', function() {
        shouldDisplayResults = false;
        let productId = $(this).data('id');
        let name = $(this).data('name');
     
        selectProduct = {
            product_id : productId,
            name : name
        }

        $('#product_id').val(productId);
        $('#input-product').val(name);
        $('#productSuggestions').fadeOut();
    });


    //Thêm sản phẩm nhập
    $(document).on("click", "#btn-add-product", function() {
        // Lấy giá trị từ các trường input
        var priceValue = document.getElementById('input-price').value;
        var quantityValue = document.getElementById('input-quantity').value;
    
        // Kiểm tra xem giá trị có hay không
        if (priceValue.trim() !== '' && quantityValue.trim() !== '' && document.getElementById('input-color').value.trim() !=null) {

            let product = {
                product_id: selectProduct != null ? selectProduct.product_id : null,
                name: selectProduct != null ? selectProduct.name : document.getElementById('input-product').value,
                quantity: quantityValue,
                price: priceValue,
                color: document.getElementById('input-color').value
            };
            products = [...products, product];

            renderProducts(product);
            appendToProducts();

            selectProduct = null;
            $('#input-product').val('');
            document.getElementById('input-color').value = '';
            document.getElementById('input-price').value = '';
            document.getElementById('input-quantity').value = "";

        } else {
            alert('Vui lòng nhập đầy đủ thông tin');
        }
    });

    function renderProducts(product) {
        let html = `
    <div class="row" id="product-${product.product_id}">
        <div class="col">
            <div class="form-group">
             <input type="text" class="form-control "  value="${product.name}" readonly>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
             <input type="text" class="form-control "  value="${product.color}" readonly>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
            <input type="text" class="form-control " value="${product.quantity}" readonly>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
            <input type="text" class="form-control " value="${product.price}" readonly>
            </div>
        </div>

         <div class="col">
            <span id="remove-product" data-id="${product.product_id}"> <i class="fa-solid fa-trash-can" style="color: #ff0000; margin-top:10px;"></i></span>
        </div>
    </div>

    `;

        $("#products-body").append(html);
    }

    function appendToProducts() {
        $("#input-products").val(JSON.stringify(products));
    }
    $(document).on("click", "#remove-product", function() {
        let id = $(this).data("id");
        removeProduct(products, id);

    });


    function removeProduct(products, id) {
        var indexToRemove = products.findIndex(product => product.product_id === id);
        if (indexToRemove >= 0) {
            $(`#product-${products[indexToRemove].product_id}`).remove();
            products.splice(indexToRemove, 1);
            appendToProducts();
        }
    }
</script>

@endsection