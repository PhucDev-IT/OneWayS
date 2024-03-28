@extends('admin.layouts.app')

@section('title', 'Thông tin banner')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin banner</h4>

        <form class="forms-sample" action={{ route('banner-store') }} method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <input type="hidden" name="id" value="{{@$banner->id}}" >
                <div class="form-group">
                    <label>Tên banner</label>
                    <input name="name" type="text" value="{{@$banner->name}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <select name="parent_id" class="form-control chosen-select chosen-select-deselect" >
                        <option value="0"> -- Danh mục -- </option>

                        @foreach($banner_cate as $item)
                            <option {{$item->id == @$banner->banner_cate->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ảnh</label>
                    <input id="image-input" type="file" value="{{@$banner->image}}" name="img_preview" accept="image/*" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" name="image" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                    @if(@$banner->image == null)
                        <img class="error_image" src="{{ asset('admin/assets/images/No_image_available.jpeg')}}" alt="">
                    @else
                        <img class="image_preload" src="{{ asset('storage/images/banner/' . basename($banner->image)) }}" alt="Banner Image">
                    @endif
                </div>
                <div class="form-group">
                    <label>Thứ tự</label>
                    <input name="ordering" type="text" value="1" class="form-control" placeholder="">
                </div>
                <div class="form-group form-check form-switch mt-4">
                    <label for="published">Kích hoạt</label>
                    <input id="published" value="1" class="check_input"
                        type="checkbox" name="published" role="switch"
                        {{ @$banner->published ? 'checked' : null }}>
                </div>
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
        hiddenLoadingPage();
    });
</script>



@endsection