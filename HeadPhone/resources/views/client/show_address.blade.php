@extends('profile')
@section('content-profile')

<style>
    .card2 {
        display: flex;
        flex-direction: column;
    }


    .address-item {
        width: calc(50% - 20px);
        /* 50% chiều rộng, trừ đi khoảng cách giữa các item */
        margin: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        position: relative;
        padding-right: 30px;
    }

    .edit-icon {
        position: absolute;
        top: 0;
        right: 0;
        padding: 5px;
    }

    .edit-icon img {
        width: 20px;
        /* Định dạng kích thước của biểu tượng chỉnh sửa */
        height: 20px;
    }
</style>
<div class="card2">

    <div class="card-header">
        <a href="{{route('profile.newAddress')}}" class="btn btn-primary">Thêm mới</a>
    </div>

    <div class="card-body">
        @foreach($list as $address)
        <div class="address-item">
            <div class="edit-icon">
                <a href=""> <i style="font-size: 20px;" class="material-icons">&#xf88d;</i></a>
            </div>
            <label for="">{{$address->name}}</label> |
            <span>+84 {{$address->phone}}</span>
            <div>
                <span>{{$address->province_name}}, {{$address->district_name}}, {{$address->ward_name}}</span>
                <div><span>{{$address->details}}</span></div>
            </div>
            <div></div>
        </div>

        @endforeach

    </div>

</div>

@endsection