@extends('admin.layouts.app')

@section('title', 'Danh mục banner')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Danh sách banner</h4>
        <div class="group_btn_function">
            <a href="{{route('banner-add')}}" class="btn btn-primary">Thêm mới</a>  
            <form action="{{route('banner_filter')}}" method="POST">   
                @csrf
                <select name="banner_categories" class="" id="">
                    <option value="0">-- Tất cả --</option>
                    @foreach($banner_categories as $item)
                    <option {{@$filter_categories == $item->id ? "selected" : null}} value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <button type="submit">
                    Tìm kiếm
                </button>
            </form>
            
        </div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            STT
                        </th>
                        <th>
                            ID banner
                        </th>
                        <th class="fix_width_name_column">
                            Tên banner
                        </th>
                        <th>
                            Danh mục banner
                        </th>
                        <th class="fix_width_img_column">
                            Ảnh 
                        </th>   
                        <th class="fix_width_ordering_column">
                            Thứ tự 
                        </th>
                        <th class="fix_width_published_column">
                            Kích hoạt 
                        </th>
                        <th>
                            Thời gian cập nhật
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($banner as $item)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <th>{{$item->id}}</th>
                        <th class="fix_width_name_column">{{$item->name}}</th>
                        <th>{{$item->banner_cate->name}}</th>
                        <th class="fix_width_img_column">
                            <img src="{{ asset('storage/images/banner/' . basename($item->image)) }}" alt="Banner Image">
                        </th>
                        <th>{{$item->ordering}}</th>
                        <th class="fix_width_published_column">
                            @if($item->published == 1)
                                <i class="published typcn typcn-input-checked"></i>
                            @else
                                <i class="unpublished typcn typcn-input-checked"></i>
                            @endif
                        </th>
                        <th>{{$item->updated_at}}</th>

                        <th><div class="group_action">
                            <a class="edit" href="{{ route('banner-edit', ['id' => $item->id]) }}">
                                <i class="typcn typcn-pencil"></i>
                                Chỉnh sửa
                            </a>
                            <a class="delete" href="{{ route('delete-banner', ['id' => $item->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
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