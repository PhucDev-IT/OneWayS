@extends('admin.layouts.app')

@section('title', 'Danh sách banner')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Danh sách banners</h4> 
        <div>

            <div class="row">
                <div class="col-md-3">
                    <a href="" class="btn btn-primary">Thêm mới</a>
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
                        {{-- @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach --}}
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
                            Hình ảnh
                        </th>
                        <th>
                            Danh mục banner
                        </th>
                        <th>
                            Kích hoạt
                        </th>
                        <th>
                            Thứ tự
                        </th>

                        <th>
                            Thời gian tạo
                        </th>
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
<script>
    $(document).ready(function() {
        hiddenLoadingPage();
    });
</script>

@endsection