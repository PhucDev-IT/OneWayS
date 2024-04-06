@extends('admin.layouts.app')

@section('title', 'Thông tin banner')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin danh mục banner</h4>

        <form class="forms-sample" action={{ route('banner-categories-store') }} method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <input type="hidden" name="id_category" value="{{@$banner->id}}" >

                <div class="form-group">
                    <label>Tên danh mục banner</label>
                    <input name="name" type="text" value="{{@$banner->name}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Thứ tự</label>
                    <input name="ordering" type="text" value="1" class="form-control" placeholder="">
                </div>
                <div class="form-group form-check form-switch mt-4">
                    <label for="published">Kích hoạt</label>
                    <input id="published" value="1" class="form-check-input float-start"
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