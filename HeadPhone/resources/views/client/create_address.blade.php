@extends('profile')
@section('content-profile')
<div class="container">
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
            <form action="{{route('profile.addAddress')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Thông tin cá nhân</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="fullName" placeholder="Enter full name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror()
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input name="phone" type="number" value="{{old('phone')}}" class="form-control" placeholder="Enter your phone">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror()
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mt-3 mb-2 text-primary">Address</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="Street">Tỉnh/Thành phố</label>
                                @error('province_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror()
                                <div id="call-provinces">
                                    <select name="province_id" id="provinces-option" class="form-control form-control-lg">
                                        <option value="" disabled selected>Tỉnh / Thành phố</option>
                                    </select>
                                </div>
                                <input type="hidden" name="province_name" id="province_name">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="ciTy">Quận/Huyện</label>
                                @error('district_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror()
                                <select name="district_id" id="districts-option" class="form-control form-control-lg">
                                    <option value="" disabled selected>Quận / Huyện</option>

                                </select>
                                <input type="hidden" id="district_name" name="district_name">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="sTate">Phường/Xã</label>
                                @error('ward_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror()
                                <select name="ward_id" id="wards-option" class="form-control form-control-lg" id="exampleFormControlSelect1">
                                    <option value="" disabled selected>Phường / Xã</option>

                                </select>
                                <input type="hidden" name="ward_name" id="ward_name">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="zIp">Chi tiết</label>
                                <input name="details" type="text" value="{{old('details')}}" class="form-control" id="zIp" placeholder="Số nhà, Tòa nhà, Tên đường, ...">
                                @error('details')
                                <span class="text-danger">{{$message}}</span>
                                @enderror()
                            </div>
                        </div>
                    </div>
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button type="button" id="submit" class="btn btn-secondary">Cancel</button>
                                <button type="submit" id="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    let provinces = [];
    //Lấy province
    $('#call-provinces').click(function() {

        if (provinces.length <= 0) {
            $.ajax({
                type: 'GET',
                url: "/api/province",
                dataType: "json",
                success: function(response) {
                    provinces = response.provinces.data;
                    $('#provinces-option').empty();
                    $.each(response.provinces.data, function(key, province) {
                        var option = new Option(province.ProvinceName, province.ProvinceID);
                        $('#provinces-option').append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Xử lý lỗi ở đây
                }
            });
        }
    })


    // Xử lý sự kiện khi select thay đổi
    $('#provinces-option').change(function() {
        var selectedProvinceID = $(this).val(); // Lấy giá trị ID của tỉnh/thành phố được chọn

        $.ajax({
            type: 'GET',
            url: '/api/districts/' + selectedProvinceID,
            dataType: "json",
            success: function(response) {

                var provincesText = $('#provinces-option option:selected').text(); // Lấy văn bản của tùy chọn đã chọn
                $('#province_name').val(provincesText); // Gán văn bản của tỉnh/thành phố vào phần tử input

                console.log(provincesText);

                $('#districts-option').empty();
                $.each(response.districts.data, function(key, district) {
                    var option = new Option(district.DistrictName, district.DistrictID);
                    $('#districts-option').append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Xử lý lỗi ở đây
            }
        });

    });

    //Call api ward
    $('#districts-option').change(function() {
        var district_id = $(this).val(); // Lấy giá trị ID của tỉnh/thành phố được chọn

        $.ajax({
            type: 'GET',
            url: '/api/wards/' + district_id,
            dataType: "json",
            success: function(response) {
                var district = $('#districts-option option:selected').text(); // Lấy văn bản của tùy chọn đã chọn
                $('#district_name').val(district); // Gán văn bản của tỉnh/thành phố vào phần tử input

                console.log(district);


                $('#wards-option').empty();
                $.each(response.wards.data, function(key, ward) {
                    var option = new Option(ward.WardName, ward.WardCode);
                    $('#wards-option').append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Xử lý lỗi ở đây
            }
        });

    });

    $('#wards-option').change(function() {
        var ward = $('#wards-option option:selected').text(); // Lấy văn bản của tùy chọn đã chọn
        $('#ward_name').val(ward); // Gán văn bản của tỉnh/thành phố vào phần tử input

        console.log(ward);
    })
</script>
@endsection