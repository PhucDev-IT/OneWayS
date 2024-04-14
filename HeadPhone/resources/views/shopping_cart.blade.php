@extends('layouts.app')

@section('title', 'Giỏ hàng')
@section('content')
@include('admin/partials/modal_loading_animations')
<style>
    .container {
        margin-top: 10px;
    }

    h3 {
        font-size: 16px;
    }

    .text-navy {
        color: #1ab394;
    }

    .cart-product-imitation {
        text-align: center;
        padding-top: 30px;
        height: 80px;
        width: 80px;
        background-color: #f8f8f9;
    }

    .product-imitation.xl {
        padding: 120px 0;
    }

    .product-desc {
        padding: 20px;
        position: relative;
    }

    .ecommerce .tag-list {
        padding: 0;
    }

    .ecommerce .fa-star {
        color: #d1dade;
    }

    .ecommerce .fa-star.active {
        color: #f8ac59;
    }

    .ecommerce .note-editor {
        border: 1px solid #e7eaec;
    }

    table.shoping-cart-table {
        margin-bottom: 0;
    }

    table.shoping-cart-table tr td {
        border: none;
        text-align: right;
    }

    table.shoping-cart-table tr td.desc,
    table.shoping-cart-table tr td:first-child {
        text-align: left;
    }

    table.shoping-cart-table tr td:last-child {
        width: 80px;
    }

    .ibox {
        clear: both;
        margin-bottom: 25px;
        margin-top: 0;
        padding: 0;
    }

    .ibox.collapsed .ibox-content {
        display: none;
    }

    .ibox:after,
    .ibox:before {
        display: table;
    }

    .ibox-title {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background-color: #ffffff;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 3px 0 0;
        color: inherit;
        margin-bottom: 0;
        padding: 14px 15px 7px;
        min-height: 48px;
    }

    .ibox-content {
        background-color: #ffffff;
        color: inherit;
        padding: 15px 20px 20px 20px;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
    }

    .ibox-footer {
        color: inherit;
        border-top: 1px solid #e7eaec;
        font-size: 90%;
        background: #ffffff;
        padding: 10px 15px;
    }
</style>

<div class="container">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>5</strong>) items</span>
                        <h5>Items in your cart</h5>
                    </div>

                    @if(isset($carts))
                    @foreach($carts->cartDetails as $cart)

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;"><input class="checkbox-item" type="checkbox" id="{{$cart->id}}" onclick="selectItemCart(this)" data-id="{{$cart->id}}"></td>
                                        <td width="90">
                                            <img src="{{asset('storage/uploads/'.$cart->product->img_preview)}}" alt="" width="90">
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy">
                                                    {{ $cart->product->name}}
                                                </a>
                                            </h3>
                                            <dl class="small m-b-none">
                                                <dt>Description lists</dt>
                                                <label for="">Color: </label>
                                                <span>{{$cart->color}}</span>
                                            </dl>

                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            <?php
                                            $currentPrice = $cart->product->price - ($cart->product->price * $cart->product->sale) / 100
                                            ?>
                                            {{ number_format($currentPrice, 0, ',', '.') }} đ
                                            <s class="small text-muted">{{ number_format($cart->product->price, 0, ',', '.') }}đ</s>
                                        </td>
                                        <td width="65">
                                            <input id="input-quanity-{{$cart->id}}" data-price="{{$currentPrice}}" onchange="updateQuantity(this)" data-id="{{$cart->id}}" style="width: auto" type="number" class="form-control" value="{{$cart->quantity}}" min=1 max=100>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    @endforeach
                    @else
                    <span>KHÔNG CÓ SẢN PHẨM NÀO</span>
                    @endif

                    <div class="ibox-content">
                        <button onclick="checkout()" class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                        <button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button>

                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 id="total" class="font-bold">
                            0 đ
                        </h2>

                        <hr>
                        <span class="text-muted small">
                            *For United States, France and Germany applicable sales tax will be applied
                        </span>
                        <div class="m-t-sm">
                            <div class="btn-group">
                                <button onclick="checkout()" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</button>
                                <a href="/" class="btn btn-white btn-sm"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Support</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <h3><i class="fa fa-phone"></i> +43 100 783 001</h3>
                        <span class="small">
                            Please contact with us if you have any questions. We are avalible 24h.
                        </span>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    let selectedCarts = [];

    //Chọn sản phẩm
    function selectItemCart(checkbox) {
        var idCart = $(checkbox).data('id');
        if (checkbox.checked) {
            selectedCarts.push(idCart);

        } else {
            var indexToRemove = selectedCarts.indexOf(idCart);
            if (indexToRemove !== -1) {
                selectedCarts.splice(indexToRemove, 1);
            }
        }
        calculateTotalMoney();
    }


    function calculateTotalMoney() {

        var carts = document.querySelectorAll('.checkbox-item');
        var totalMoney = 0;
        carts.forEach(function(item) {
            if (item.checked) {
                var id = item.id;
                var quantity = $('#input-quanity-' + id).val();
                var price = $('#input-quanity-' + id).data('price');

                totalMoney += (quantity * price);
            }
        });

        $('#total').text(formatCurrency(totalMoney));


    }

    function updateQuantity(element) {
        var idCart = element.getAttribute('data-id');
        var quantity = element.value;

        // var remaining = element.getAttribute('data-remaining');
        // if (quantity > remaining) {
        //     $('#input-quanity-' + idCart).value = remaining;
        //     return;
        // }

        $.ajax({
            type: 'POST',
            url: "{{route('cart.update_quantity')}}",
            data: {
                _token: '{{ csrf_token() }}',
                idCart: idCart,
                quantity: quantity,
            },
            dataType: "json",
            success: function(response) {
                console.log(response)
                $('#input-quanity-' + idCart).value = response.cart_count;
                calculateTotalMoney();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    //Nhấn mua hàng
    function checkout($selectedCarts) {
        if (selectedCarts.length <= 0) {
            alert("Chọn sản phẩm trước khi mua hàng");
            return;
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('checkout.request') }}",
            data: {
                _token: '{{ csrf_token() }}',
                carts: selectedCarts
            },
            dataType: 'json',
            success: function(response) {
                window.location.href = response;

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })

    }
</script>
@endsection