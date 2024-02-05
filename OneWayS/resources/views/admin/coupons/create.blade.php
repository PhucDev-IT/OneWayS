@extends('admin.layouts.app')

@section('title', 'Thêm mã giảm giá')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm mã giảm giá</h4>

        <form class="forms-sample" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
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
                            <input name="discount" value="{{old('discount')}}" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="100000">
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
                        <option selected>Giảm giá theo tiền</option>
                            <option>Miễn phí vận chuyển</option>
                            <option>Giảm giá theo phần trăm %</option>
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
                        <input type="datetime-local" name="start_time" value="" class="form-control" placeholder="dd/MM/yyyy">
                        @error('start_time')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="datetime-local" name="end_time" value="" class="form-control" placeholder="dd/MM/yyyy">
                        @error('end_time')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>
            </div>


            <div class="form-group">
            <label>Số lượng</label>
                <input id="quantity" type="number" class="form-control " min="1" placeholder="Số lượng">
            </div>

            <div class="form-group">
            <label>Tặng người dùng (bỏ trống nếu không tặng riêng)</label>
                <input  type="email" class="form-control " placeholder="abc@gmail.com">
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