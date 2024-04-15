@extends('layouts.app')

@section('content')
<style>
    .coupon {
        height: min-content;
        border: 1px solid #D10024;
        border-radius: 10px;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-content: center;
        text-align: center;
    }

    .card-radio {
        background-color: #fff;
        border: 2px solid #eff0f2;
        border-radius: .75rem;
        padding: .5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block
    }

    .card-radio:hover {
        cursor: pointer
    }

    .card-radio-label {
        display: block
    }

    .card-radio-input {
        display: none
    }

    .card-radio-input:checked+.card-radio {
        border-color: #3b76e1 !important
    }

    /* -----------------------------------------Đăng bài------------------------------------------------------------- */
    /* width */
    .modal-coupon::-webkit-scrollbar {
        width: 0px;
    }

    /* Track */
    .modal-coupon ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    .modal-coupon::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .modal-coupon::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .modal-coupon {

        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        overflow: scroll;
        /* Nằm giữa chiều ngang của thẻ cha */
        justify-content: center;

    }

    .icon-close {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        padding-right: 15px;
    }

    .modal-container-post input:focus {
        outline: none;
    }

    .modal-header {
        position: relative;
        height: 50px;
        background-color: #d15f4f;
        box-sizing: border-box;
        display: flex;
        align-items: center;
    }

    .modal-container {
        height: 170rem;
        width: 70rem;
        margin-top: 6rem;
        min-height: 115rem;
        background-color: #ffffff;
        position: relative;

    }

    .modal-header h5 {
        padding-top: 0.7rem;
        padding-left: 1.3rem;
        font-size: 2.5rem;
        box-sizing: border-box;
    }


    #btn-post {
        margin-top: 3.3rem;
        display: block;
        width: 13.3rem;
        height: 2.6rem;
        margin: 0 auto;
        margin-top: 2rem;
        font-size: 1.3rem;
        background-color: #FDF5E6;
        border-radius: 0.3rem;
        border: 1px solid green;
    }

    #btn-post:hover {
        background-color: aquamarine;
    }
</style>

<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>



<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Information Bill</h3>
                    </div>
                    @foreach($cartDetails as $item)

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <tr>

                                        <td width="90">
                                            <img src="{{asset('storage/uploads/'.$item->product->img_preview)}}" alt="" width="90">
                                        </td>
                                        <td class="desc">
                                            <h4>
                                                <span> {{ $item->product->name}}</span>
                                            </h4>
                                            <?php
                                            $currentPrice = $item->product->price - ($item->product->price * $item->product->sale) / 100
                                            ?>
                                            <dl class="small m-b-none">
                                                <p>x {{$item->quantity}}</p>
                                                <label>Phân loại: </label>
                                                <span>{{$item->color}}</span>
                                                <h5 style="color: red;" for=""> {{ number_format($currentPrice, 0, ',', '.') }} đ</h5>
                                            </dl>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    @endforeach

                </div>
                <!-- ĐƠN VỊ VẬN CHUYỂN -->
                <div style="margin-bottom: 20px;">
                    <h5>Đơn vị vận chuyển</h5>
                    <section id="transport-units">

                    </section>
                </div>

                <!-- THÔNG TIN NHẬN HÀNG -->
                <div>
                    <h5 class="font-size-16 mb-1">Thông tin vận chuyển</h5>
                    <p class="text-muted text-truncate mb-4">Thông tin nhận hàng của bạn</p>
                    <div class="mb-3">
                        @if(count($addresses) <= 0) <span style="display: inline;">Bạn chưa thêm địa chỉ nhận hàng!</span>
                            <a href="{{route('profile.fetchAddress')}}">Nhấn để thêm ngay</a>
                            @else
                            @foreach($addresses as $address)
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div data-bs-toggle="collapse">
                                        <label class="card-radio-label mb-0">
                                            <input type="radio" name="address" id="info-address-{{$address->id}}" class="card-radio-input" data-district="{{$address->district_id}}" value="{{$address->id}}">
                                            <div class="card-radio text-truncate p-3" style="width: max-content;">
                                                <!-- <span class="fs-14 mb-4 d-block">Mặc định</span> -->
                                                <span style="display: inline;" class="fs-14 mb-2 d-block">{{$address->name}} | </span>
                                                <span style="display: inline;">{{$address->phone}}</span>
                                                <span style="font-weight: 200; display: block;" class="text-muted fw-normal text-wrap mb-1 d-block">{{$address->ward_name}}, {{$address->district_name}}, {{$address->province_name}}</span>
                                                <span style="font-weight: 200;" class="text-muted fw-normal d-block">
                                                    ( {{$address->details}} )
                                                </span>

                                            </div>
                                        </label>
                                        <div class="edit-btn bg-light  rounded">
                                            <a href="/Profile/Index" data-bs-toggle="tooltip" data-placement="top" title data-bs-original-title="Edit">
                                                <i class="bx bx-pencil font-size-16"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @endif
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Checkout</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <?php
                    $total = 0
                    ?>
                    <div class="order-products">
                        @foreach($cartDetails as $item)
                        <div class="order-col">
                            <div>x{{$item->quantity}} {{$item->product->name}}</div>
                            <div>{{ number_format($currentPrice * $item->quantity, 0, ',', '.') }}đ</div>
                        </div>
                        <?php
                        $total  += $currentPrice * $item->quantity
                        ?>
                        @endforeach

                    </div>
                    <div class="order-col">
                        <div>Shiping</div>
                        <div><strong id="fee-ship">Chưa chọn địa chỉ</strong></div>
                    </div>
                    <div class="order-col">
                        <div>Voucher</div>
                        <div><strong id="coupon_discount">0đ</strong></div>
                    </div>
                    <div class="order-col">
                        <div><strong>TOTAL</strong></div>
                        <div><strong id="total-money" class="order-total">{{ number_format($total, 0, ',', '.') }}đ</strong></div>
                    </div>
                    <input type="hidden" id="total-cache" value="{{$total}}">
                </div>

                <div id="select-coupon" class="coupon">
                    <label>COUPON: </label>
                    <label id="id_coupon" for=""></label>
                    <a href="#" class="more" title="Xem thêm" data-toggle="tooltip"><i style="font-size: 20px;" class="material-icons">&#xe409;</i></a>
                </div>


                <div class="payment-method">
                    <div>
                        <h5 class="font-size-14 mb-3">Phương thức thanh toán :</h5>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div data-bs-toggle="collapse">
                                    <label class="card-radio-label">
                                        <input type="radio" name="pay-method" value="MOMO" id="pay-methodoption1" class="card-radio-input">
                                        <div class="card-radio py-3 text-center text-truncate">
                                            <img width="35" style="display: block; margin: 0 auto;" src="https://img.mservice.io/momo-payment/icon/images/logo512.png" class="d-block h2 mb-3" alt="">
                                            <span>Momo</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label class="card-radio-label">
                                        <input type="radio" name="pay-method" value="VNPAY" id="pay-methodoption2" class="card-radio-input">
                                        <span class="card-radio py-3 text-center text-truncate">
                                            <img width="35" style="display: block; margin: 0 auto;" src="https://www.nexusinw.com/wp-content/uploads/2017/08/Paypal-icon.png" alt="">
                                            VnPay
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label class="card-radio-label">
                                        <input type="radio" name="pay-method" value="CASH" id="pay-methodoption3" class="card-radio-input" checked>
                                        <span class="card-radio py-3 text-center text-truncate">
                                            <img width="35" style="display: block; margin: 0 auto;" src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/512x512/hand_money.png" alt="">
                                            <span>Khi nhận hàng</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-checkbox">
                    <input type="checkbox" id="terms">
                    <label for="terms">
                        <span></span>
                        I've read and accept the <a href="#">terms & conditions</a>
                    </label>
                </div>
                <a onclick="payment()" class="primary-btn order-submit">Place order</a>
            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- MODAL ---------- VOUCHER  -->
<div class="modal-coupon" style="visibility: hidden">
    <div class="modal-container">
        <div class="modal-header">
            <h5>Chọn mã giảm giá</h5>
            <div class="icon-close"><i style="font-size: 20px;" class="modal-close material-icons" style="color: #f5eded;position: absolute; right: 1.6rem; top: 1.6rem; font-size: 1.6rem;">&#xe5cd;</i></div>
        </div>

        <div id="voucher-contain" class="modal-body">
        
        </div>
    </div>

</div>


@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    let address_id = null;
    let feeShip = 0;
    let idCouponSelected = null;
    let totalMoney = parseFloat($('#total-cache').val());


    function transportUnit(district_id) {
        $.ajax({
            url: "{{ route('checkout.service') }}",
            type: 'GET',
            data: {
                to_district: district_id
            },
            dataType: 'json',
            success: function(response) {
                $('#transport-units').empty();
                $.each(response.data, function(key, value) {
                    if (key === 0) { // Chỉ thêm thuộc tính checked cho phần tử đầu tiên
                        $('#transport-units').append(`
                            <input type="radio" onclick="calculateFee(${value.service_id})" id="option_${value.service_id}" name="options" value="${value.service_id}" checked>
                            <label for="option_${value.service_id}">${value.short_name}</label><br>
                        `);
                        calculateFee(value.service_id)
                    } else {
                        $('#transport-units').append(`
                        <input type="radio" onclick="calculateFee(${value.service_id})" id="option_${value.service_id}" name="options" value="${value.service_id}">
                            <label for="option_${value.service_id}">${value.short_name}</label><br>
                        `);
                    }
                });

            },
            error: function(xhr, status, error) {
                console.error(error);
                // Xử lý lỗi ở đây
            }
        });
    }

    function calculateFee(service_id) {

        //   calculate();
        $.ajax({
            type: 'GET',
            url: "{{ route('checkout.fee') }}",
            dataType: 'json',
            data: {
                service_id: service_id
            },
            success: function(response) {

                var total = parseFloat($('#total-cache').val());
                feeShip = response.data.total;
                totalMoney = response.data.total + total;
                $('#total-money').html(formatCurrency(totalMoney));
                $('#fee-ship').html(formatCurrency(response.data.total));

            }
        });
    }

    function payment() {
        if (address_id == null) {
            alert('Vui lòng chọn địa chỉ nhận hàng');
            return;
        }

        var order = {
            method_payment: methodPayment(),
            total: parseFloat($('#total-cache').val()),
            feeship: feeShip,
            totalmoney: totalMoney,
            voucher_id: idCouponSelected,
            address_id: address_id,
            current_status:'PENDING',
            redirect:'/completed',

        };
        var requestData = {
            order: order,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            type: 'POST',
            url: "{{ route('checkout.payment') }}",
            data: JSON.stringify(requestData),
            contentType: 'application/json; charset=utf-8',
            success: function(response) {
                var responseData = JSON.parse(response);
                console.log(responseData);
               window.location.href = responseData.payUrl;
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function showPostForm() {
        var BtnPost = document.querySelector('#select-coupon');
        var postForm = document.querySelector('.modal-coupon');
        var btnClose = document.querySelector('.modal-close');
        BtnPost.addEventListener('click', function() {
            postForm.style = "visibility:active";
            getvouchers();
        })

        btnClose.addEventListener('click', function() {
            postForm.style = "visibility:hidden";
        });
    });

    function getvouchers() {
        $.ajax({
            type: 'GET',
            url: "{{ route('checkout.getvouchers') }}",
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#voucher-contain').empty();
                $.each(response, function(key, coupon) {
                    var title = '';
                    if (coupon.type == 'FreeShip') {
                        title = 'Miễn phí vận chuyển';
                    } else if (coupon.type == 'DISCOUNTPERCENT') {
                        title = 'Giảm ' + coupon.discount + '%';
                    } else {
                        title = 'Giảm ' + formatCurrency(coupon.discount);
                    }
                   // var isChecked = idCouponSelected === coupon.voucher_id ? 'checked' : '';
                    
                    $('#voucher-contain').append(`
                        <div onclick="selectCoupon('${encodeURIComponent(JSON.stringify(coupon))}')"  class="row">
                            <div class="col-lg-4 col-sm-6" style="width: 100%;">
                                <div data-bs-toggle="collapse">
                                    <label class="card-radio-label mb-0">
                                 
                                        <input type="radio"  class="card-radio-input" >
                                        <div class="card-radio text-truncate p-3" style="width: 100%;">
                                            <!-- <span class="fs-14 mb-4 d-block">Mặc định</span> -->
                                            <span style="color: #de23ce;" class="fs-14 mb-2 d-block">${coupon.voucher_id} | </span>
                                            
                                            <span >
                                                ${title}
                                            </span>
                                            <span style="font-weight: 200;" class="text-muted fw-normal d-block">
                                                ( ${coupon.quantity} )
                                            </span>
                                            <span style="font-weight: 200; display: block;" class="text-muted fw-normal text-wrap mb-1 d-block">${coupon.description}</span>
                                    
                                            <span style="font-weight: 200;" class="text-muted fw-normal d-block">
                                                Hết hạn sau: ${coupon.end_time}
                                            </span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        `);
                });

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function selectCoupon(obj) {
        var object = JSON.parse(decodeURIComponent(obj))
        var total = parseFloat($('#total-cache').val());
        var voucher = document.getElementById("id_coupon");
        voucher.innerText = object.voucher_id;

        idCouponSelected = object.voucher_id;

        if (object.type == "FreeShip") {
            $('#coupon_discount').html('- ' + formatCurrency(feeShip));
            $('#total-money').html(formatCurrency(total));
            totalMoney = total;
        } else if (object.type == "DISCOUNTPERCENT") {
            console.log('hello');
            totalMoney = total - ((total * object.discount) / 100);
            $('#coupon_discount').html('- ' + formatCurrency(total * (object.discount / 100)));
            $('#total-money').html( formatCurrency(total));

        } else {
            totalMoney = total + feeShip - object.discount;
            $('#coupon_discount').html('- ' + formatCurrency(object.discount));
            $('#total-money').html(formatCurrency(totalMoney));
        }

    }

    $('input[type="radio"][name="address"]').click(function() {
        if ($(this).prop('checked')) {
            var value = $(this).val();
            var districtData = $(this).data('district');
            address_id = value;
            transportUnit(districtData);
        }
    })


    //Lấy phương thức thanh toán đã chọn
    function methodPayment() {
        var radioButtons = document.querySelectorAll('input[name="pay-method"]');

        for (var i = 0; i < radioButtons.length; i++) {
            var radioButton = radioButtons[i];

            if (radioButton.checked) {
                var payMethodValue = radioButton.value;
                return payMethodValue;
            }
        }

        // Trả về một giá trị mặc định nếu không có phần tử nào được chọn
        return null;
    }
</script>
@endsection