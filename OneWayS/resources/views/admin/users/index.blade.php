@extends('admin.layouts.app')

@section('title', 'Users')
@section('content')
@include('admin/partials/modal_remove')
<style>
    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #299be4;
        color: #fff;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .table-title .btn {
        color: #566787;
        float: right;
        font-size: 13px;
        background: #fff;
        border: none;
        min-width: 50px;
        border-radius: 2px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table-title .btn:hover,
    .table-title .btn:focus {
        color: #566787;
        background: #f2f2f2;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 100px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.settings {
        color: #2196F3;
    }

    table.table td a.delete {
        color: #F44336;
    }

    table.table td i {
        font-size: 19px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }

    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    .text-success {
        color: #10c469;
    }

    .text-info {
        color: #62c9e8;
    }

    .text-warning {
        color: #FFC107;
    }

    .text-danger {
        color: #ff5b5b;
    }

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a,
    .pagination li.active a.page-link {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
</style>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>User <b>Management</b></h2>
                    </div>
                    <div class="col-sm-7">
                        <div><a href="{{route('users.create')}}" class="btn btn-primary">Thêm mới</a></div>

                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>


@endsection

@section('script')

<script>
    // Hiển thị modal khi người dùng nhấn nút xóa
    function showModelConfirm(value) {
        var id = $(value).data('id');
        var status = $(value).data('status');

        if (status === 0) {
            document.getElementById('modal-body__text').innerHTML = 'Bạn có chắc muốn mở khóa tài khoản này?';
        } else {
            document.getElementById('modal-body__text').innerHTML = 'Bạn có chắc muốn khóa tài khoản này?';
        }
        $('#confirmDeleteModal').data('status', status);
        $('#confirmDeleteModal').data('itemid', id).modal('show');
    }


    // Gọi hành động xóa khi xác nhận
    $('#confirmDeleteButton').click(function() {
        var itemId = $('#confirmDeleteModal').data('itemid');
        var status = $('#confirmDeleteModal').data('status');

        $.ajax({
            url: '/api/lock-on-user',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: itemId,
                status: status
            },
            success: function(response) {
                fetchData();
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('#confirmDeleteModal').modal('hide');
    });


    //Dùng API Call data from serve after render to view
    fetchData();

    function fetchData() {
        showLoadingPage();

        $.ajax({
            type: 'GET',
            url: "/api/fetch-user",
            dataType: "json",
            success: function(response) {
                hiddenLoadingPage();
                $('tbody').empty();
                let i = 0;
                $.each(response.users.data, function(key, user) {
                 
                    var avatarUrl = "{{ asset('storage/uploads/') }}" + '/' + user.avatar;

                    $('tbody').append(`
                    <tr>
                    <td>${++i}</td>
                    <td><a href="#"><img src="${avatarUrl}" class="avatar" alt="Avatar">${user.name}</a></td>
                    <td>${user.createdat}</td>
                    <td>
                        ${
                            user.roles ? user.roles.map(function(role) {
                                return `<label class="badge badge-success">${role.display_name}</label>`;
                            }).join('') : '' // Nếu user.roles không tồn tại, trả về chuỗi rỗng
                        }
                    </td>

                    <td>
                        ${user.status == '0' ? '<span class="status text-success">&bull;</span> Mở' : '<span class="status text-danger">&bull;</span> Khóa'}
                    </td>
                    <td>
                        <a href="/users/${user.id}/edit" class="edit" title="Sửa" data-toggle="tooltip" style="color: #ff0000;"><i class="material-icons" style="color: #f0da35;">&#xE254;</i></a>
                        ${user.status == '0' ? '<a onclick="showModelConfirm(this)" data-id="' + user.id + '" data-status="1" class="lock" title="Khóa" data-toggle="tooltip" style="color: #e64e30;"><i class="material-icons">&#xe897;</i></a>' : '<a onclick="showModelConfirm(this)" data-id="' + user.id + '" data-status="0" class="lock" title="Mở" data-toggle="tooltip" style="color: #12e34a;"><i class="material-icons">&#xe898;</i></a>'}
                    </td>
                    </tr>
            `);
                });
            }
        });

    }
</script>

@endsection