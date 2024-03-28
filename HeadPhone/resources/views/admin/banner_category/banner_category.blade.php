@extends('admin.layouts.app')

@section('title', 'Danh mục banner')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Quản lý danh mục banner</h4>
        <div><a href="{{route('banner-categories-add')}}" class="btn btn-primary">Thêm mới</a></div>
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
                        <th>{{$item->id}}</th>
                        <th>{{$item->name}}</th>
                        <th>
                            @if($item->published == 1)
                                <i class="published typcn typcn-input-checked"></i>
                            @else
                                <i class="unpublished typcn typcn-input-checked"></i>
                            @endif
                        </th>
                        <th>{{$item->ordering}}</th>
                        <th>{{$item->updated_at}}</th>
                        <th>
                            <div class="group_action">
                                <a class="edit" href="{{ route('banner-categories-edit', ['id' => $item->id]) }}">
                                    <i class="typcn typcn-pencil"></i>
                                    Chỉnh sửa
                                </a>
                                <a class="delete" href="{{ route('delete-banner-categories', ['id' => $item->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                                    <i class="typcn typcn-trash"></i>
                                    Xoá
                                </a>
                            </div>
                        </th>
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