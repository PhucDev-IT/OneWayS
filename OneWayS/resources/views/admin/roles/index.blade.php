@extends('admin.layouts.app')

@section('title', 'Roles')
@section('content')
@include('admin/partials/modal_remove')

<div class="card"  style="padding: 20px;">
    <h1>Phân quyền</h1>
    <div><a href="{{route('roles.create')}}" class="btn btn-primary">Thêm mới</a></div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Action</th>
            </tr>

            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td>
                <a href="{{route('roles.edit',$role->id)}}" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i></a>
                <span id="btn-remove" onclick="showModelConfirm(this)" data-id="{{$role->id}}"> <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></span>
                <form action="{{route('roles.destroy',$role->id)}}" id="form-delete{{$role->id}}" method="post">
                    @csrf
                    @method('delete')
                    
                </form>
                
                
                </td>
            </tr>
            @endforeach
        </table>
        {{$roles->links()}}
    </div>

</div>

<script>
      // Hiển thị modal khi người dùng nhấn nút xóa
      function showModelConfirm(value) {
        var id = $(value).data('id');
        $('#confirmDeleteModal').data('itemid', id).modal('show');
    }

     // Gọi hành động xóa khi xác nhận
     $('#confirmDeleteButton').click(function() {
    
        var itemId = $('#confirmDeleteModal').data('itemid');
        $('#form-delete'+itemId).submit();
        $('#confirmDeleteModal').modal('hide');
    });
</script>
@endsection