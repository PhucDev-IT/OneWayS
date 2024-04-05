@extends('admin.layouts.app')

@section('title', 'Nhập hàng')
@section('content')
@include('admin/partials/modal_remove')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin nhập hàng</h4>
        <div><a href="{{route('imports.create')}}" class="btn btn-primary">Thêm mới</a></div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Mã phiếu nhập
                        </th>
                        <th>
                            Ngày nhập
                        </th>
                        <th>
                            Tổng tiền
                        </th>
                        <th>
                            Nhà cung cấp
                        </th>
                        <th>
                           Thực hiện bởi
                        </th>
                    
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->total}}</td>
                            <td>{{$item->supplier->name}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                            <a href="" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i></a>
                            <span id="btn-remove" > <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></span>
                            </td>
                        </tr>

                    @endforeach
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
  hiddenLoadingPage();
</script>

@endsection