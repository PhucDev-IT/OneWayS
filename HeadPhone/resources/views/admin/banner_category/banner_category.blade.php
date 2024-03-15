@extends('admin.layouts.app')

@section('title', 'Danh mục banner')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Quản lý danh mục banner</h4>
        <div><a href="" class="btn btn-primary">Thêm mới</a></div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Tên danh mục
                        </th>
                        <th>
                            Kích hoạt
                        </th>
                        <th>
                            Thứ tự 
                        </th>   
                        <th>
                            Ngày cập nhật 
                        </th>
                        <th>
                            Action
                        </th>

                    </tr>
                </thead>
                <tbody>
                @foreach($banner as $item)
                    <tr>
                        <th>{{$item->name}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    hiddenLoadingPage();
</script>

@endsection