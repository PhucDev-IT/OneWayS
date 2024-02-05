@extends('admin.layouts.app')

@section('title', 'Users')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm mới danh mục</h4>
        <p class="card-description">
            Phân loại danh mục để dễ dàng quản lý sản phẩm của bạn
        </p>
        <form action="{{route('categories.store')}}" method="post" class="forms-sample">
            @csrf
            <div class="form-group">
                <label>Tên danh mục</label>
                <input name="name" value="{{old('name')}}" type="text" class="form-control" placeholder="Tên danh mục">
                @error('name')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>

@endsection