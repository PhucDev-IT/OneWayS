@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm sản phẩm mới</h4>

        <form class="forms-sample" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div>
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input id="image-input" type="file" name="img_preview" accept="image/*" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                        @error('img_preview')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>

                    <div class="form-group">
                        <input id="files_multiple" type="file" name="images[]" accept="image/*" class="file-upload-default" multiple>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" hidden>
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-outline-secondary btn-fw" type="button">Thêm nhiều ảnh preview</button>
                            </span>
                        </div>
                    </div>

                </div>

                <div style="margin-bottom: 30px;">
                    <img src="" id="show-image" alt="" width="200px" style="border: 2px solid black;">
                    <div id="preview" class="row"></div>
                </div>
            </div>

            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Tai nghe bluetooth thế hệ 6.0">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="">Đơn giá</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input name="price" value="{{old('price')}}" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="100000">
                            <div class="input-group-append">
                                <span class="input-group-text">vnđ</span>
                            </div>
                        </div>
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label class="">Sale</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input name="sale" value="{{old('sale')}}" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="1000">
                            <div class="input-group-append">
                                <span class="input-group-text">vnđ</span>
                            </div>
                        </div>
                        @error('sale')
                        <span class="text-danger">{{$message}}</span>
                        @enderror()
                    </div>
                </div>
            </div>

            <div>
                <input type="hidden" id="inputClassifies" name='classifies'>
                <label>Phân loại</label>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input id="input-color" type="text" class="form-control " placeholder="Màu sắc">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <input id="input-quantity" type="number" class="form-control " min="1" placeholder="Số lượng">
                        </div>
                    </div>
                    <div class="col">
                        <button type="button" id="btn-add-classify" class="btn btn-primary">Thêm</button>
                    </div>
                </div>

                <div id="classify-body">

                </div>
            </div>

            <div class="form-group">
                <label for="exampleTextarea1">Mô tả chi tiết sản phẩm</label>
                <textarea class="form-control" name="description" rows="6">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>


            <div class="form-group">
                <label for="">Sản phẩm thuộc danh mục</label>
                <div class="row">
                    @foreach($categories as $item)
                    <div class="form-check col-2">
                        <label class="form-check-label">
                            <input name="category_ids[]" type="checkbox" class="form-check-input" value="{{$item->id}}">
                            {{$item->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('category_ids')
                <span class="text-danger"> {{ $message }}</span>
                @enderror

            </div>

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="button" class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>



@endsection

@section('script')
<script src="{{ asset('admin/assets/js/product/product.js') }}"></script>
<script>
    let classifies = [];

    renderClassifies(classifies);

    $('#files_multiple').change(function(e) {
        // Lấy danh sách các tệp đã chọn
        var files = e.target.files;
        $("#preview").empty();
        // Hiển thị tên các tệp đã chọn
        for (var i = 0; i < files.length; i++) {
            renderImage(files[i]);
        }

    });
</script>


@endsection