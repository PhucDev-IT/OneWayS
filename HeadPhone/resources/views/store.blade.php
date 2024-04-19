@extends('layouts.app')
@section('title', 'Sản phẩm')
@section('content')
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <form action="{{route('store.filler')}}">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Categories</h3>
                        <div class="checkbox-filter">
                            @foreach($categories as $category)
                            <div class="input-checkbox">
                                <input type="checkbox" value="{{$category->id}}" name="category_ids" id="category-{{$category->id}}">
                                <label for="category-{{$category->id}}">
                                    <span></span>
                                    {{$category->name}}
                                    <small>({{$category->products_count}})</small>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Price</h3>
                        <div class="price-filter">
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number" name="price-min">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number" name="price-max">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Brand</h3>
                        <div class="checkbox-filter">
                            @foreach($suppliers as $item)

                            <div class="input-checkbox">
                                <input type="checkbox" name="supplier_ids" value="{{$item->id}}" id="brand-{{$item->id}}">
                                <label for="brand-{{$item->id}}">
                                    <span></span>
                                    {{$item->name}}
                                    <small>({{$item->products_count}})</small>
                                </label>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- /aside Widget -->
                </form>
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
        
                <!-- store products -->
                <div class="row" id="store-products">
                    <!-- product -->
                    @foreach($products as $product)
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{asset('storage/uploads/'.$product->img_preview)}}" alt="">
                                <div class="product-label">
                                    @if($product->sale > 0)
                                    <span class="sale">{{$product->sale}}%</span>
                                    @endif
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a  href="{{route('products.show_details',['id' => $product->id])}}">{{ $product->name }}</a></h3>

                                <h4 class="product-price">{{ number_format($product->price - ($product->price * $product->sale)/100, 0, ',', '.') }} đ <del class="product-old-price">{{ number_format($product->price, 0, ',', '.') }}đ</del></h4>

                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    {{$products->links()}}
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    var category_ids = [];
    var supplier_ids = [];

    $('input[type="checkbox"]').click(function() {
        var value = $(this).val();
        var name = $(this).attr('name');

        // Kiểm tra xem checkbox được nhấp có được chọn hay không
        if ($(this).prop('checked')) {
            // Nếu checkbox được chọn, thêm giá trị vào mảng tương ứng
            if (name == 'category_ids') {
                category_ids.push(value);
            } else {
                supplier_ids.push(value);
            }
        } else {
            // Nếu checkbox không được chọn, loại bỏ giá trị khỏi mảng tương ứng
            if (name == 'category_ids') {
                category_ids = category_ids.filter(function(item) {
                    return item !== value;
                });
            } else {
                supplier_ids = supplier_ids.filter(function(item) {
                    return item !== value;
                });
            }
        }

        $.ajax({
            type: 'POST',
            url: '/api/products/filler',
            data: {
                _token: '{{ csrf_token() }}',
                category_ids: category_ids,
                supplier_ids: supplier_ids
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#store-products').empty();
                $.each(response,function(key,product){
                    setProducts(product);
                })
            }
        })
    });

    function setProducts(product){
        $('#store-products').append(`
        <div class="col-md-4 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{asset('storage/uploads/${product.img_preview}')}}" alt="">
                                <div class="product-label">
                                ${product.sale > 0 ? `<span class="sale">${product.sale}%</span>` : ''}
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="/show/product/?id=${product.id}">${product.name}</a></h3>

                                <h4 class="product-price">${formatCurrency(product.price - (product.price*product.sale)/100)} đ <del class="product-old-price">${formatCurrency(product.price)}đ</del></h4>

                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                            </div>

                        </div>
                    </div>
        `);
    }
</script>
@endsection