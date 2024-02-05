@extends('admin.layouts.app')

@section('title', 'Users')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tất cả voucher hiện có</h4>
        <div><a href="{{route('vouchers.create')}}" class="btn btn-primary">Thêm mới</a></div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Mã voucher
                        </th>
                        <th>
                            Tiêu đề
                        </th>
                        <th>
                            Giảm giá
                        </th>
                        <th>
                            Số lượng
                        </th>
                        <th>
                            Đã dùng
                        </th>
                        <th>
                            Loại voucher
                        </th>
                        <th>
                            Bắt đầu
                        </th>
                        <th>
                            Kết thúc
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $item)
                    <tr>
                        <td>
                        {{ $item->id }}
                        </td>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                           {{$item->discount}}
                        </td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->used}}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->start_time}}</td>
                        <td>{{$item->end_time}}</td>
                        <td>
                        <a href="{{route('vouchers.edit',$item->id)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                      
                    </tr>
                    @endforeach
                   
                 
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection