@extends('admin.layouts.app')

@section('title', 'Thêm mã giảm giá')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm mã giảm giá</h4>

        <form class="forms-sample" action="{{route('vouchers.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Tiêu đề</label>
                <input name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Tặng bạn voucher giảm 20.000đ">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="">Giảm</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input id="input_discount" min='1' name="discount" value="{{old('discount')}}" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="100000">
                            <div class="input-group-append">
                                <span class="input-group-text">vnđ</span>
                            </div>
                        </div>
                        @error('discount')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label class="">Loại giảm giá</label>
                        <select name="type" class="form-control">
                            <option value="DiscountMoney" selected>Giảm giá theo tiền</option>
                            <option value="FreeShip">Miễn phí vận chuyển</option>
                            <option value="DiscountPercent">Giảm giá theo phần trăm %</option>
                        </select>
                        @error('type')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
                        <input type="datetime-local" onchange="onSubmit()" name="start_time" value="" class="form-control" placeholder="dd/MM/yyyy">
                        @error('start_time')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="datetime-local" onchange="onSubmit()" name="end_time" value="" class="form-control" placeholder="dd/MM/yyyy">
                        @error('end_time')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Số lượng</label>
                <input id="quantity" name="quantity" type="number" class="form-control " min="1" placeholder="Số lượng">
                @error('quantity')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>

            <div class="form-group">
                <label>Tặng người dùng (bỏ trống nếu không tặng riêng)</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input id="user_id" type="hidden" name="user_id" />
                    <input id="input-email" name="email_user" type="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="abc@gmail.com">
                </div>
                <!-- Container để hiển thị gợi ý -->
                <div id="userSuggestions">

                </div>
            </div>

            <div class="form-group">
                <label for="exampleTextarea1">Mô tả</label>
                <textarea class="form-control" name="description" rows="6">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="button" class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Xử lý sự kiện khi người dùng nhập vào input
        $('#input-email').keyup(function() {
            // Lấy giá trị người dùng nhập
            var query = $(this).val();

            $("#userSuggestions").empty();
            // Gọi Ajax để tìm kiếm người dùng
            $.ajax({
                url: '/search-users',
                method: 'GET',
                data: {
                    query: query
                },
                success: function(response) {
                    displaySuggestions(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    // Hàm hiển thị gợi ý người dùng
    function displaySuggestions(users) {
        $("#userSuggestions").empty();

        if (users.length > 0) {

            let list = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%" >';
            users.forEach(function(user) {
                list += `<li data-id="${user.id}" data-email = "${user.email}" ><span class="dropdown-item"> ${user.email} - ${user.fullname} </span> </li>`;
            });
            list += '</ul>';

            $("#userSuggestions").append(list);

        }
    }

    $(document).on('click', 'li', function() {
        let userId = $(this).data('id');
        let userEmail = $(this).data('email');
        $('#user_id').val(userId);
        $('#input-email').val(userEmail);
        $('#userSuggestions').fadeOut();
    });

    $('select[name="type"]').on('change', function() {
        var selectedValue = $(this).val();
        document.getElementById('input_discount').removeAttribute('readonly');

        // Thực hiện xử lý tùy thuộc vào giá trị được chọn
        switch (selectedValue) {
            case 'DiscountMoney':

                break;
            case 'FreeShip':
                $('#input_discount').val(1);
                document.getElementById('input_discount').setAttribute('readonly', 'true');
                break;
            case 'DiscountPercent':
                console.log('phần trăm');
                break;
            default:
                // Xử lý mặc định
                break;
        }
    });

    function onSubmit() {

        var start = new Date($('input[name="start_time"]').val()); // or Date.parse(...)
        var end = new Date($('input[name="end_time"]').val()); // or Date.now()
        if (start.getTime() > end.getTime()) {
            alert('Thời gian kết thúc phải lớn hơn thời gian hiện tại')
            $('input[name="end_time"]').val(null);
        }
    }
</script>

@endsection