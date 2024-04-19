@extends('admin.layouts.app')

@section('title', 'Thêm vai trò')
@section('content')


<div class="card" style="padding: 20px;">
    <h1>Thêm mới vai trò người dùng</h1>

    <div>

        <form action="{{route('roles.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="exampleInputUsername1">Name</label>
                <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="Username">

                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>

            <div class="form-group">
                <label for="exampleInputUsername1">Display Name</label>
                <input name="display_name" type="text" class="form-control" value="{{old('display_name')}}" placeholder="Username">
                @error('display_name')
                <span class="text-danger">{{$message}}</span>
                @enderror()
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Group</label>
                <select name="group" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option selected value="system">System</option>
                    <option value="user">User</option>
                </select>
            </div>



            <div class="form-group">
                <label for="exampleInputUsername1">Phân quyền</label>
                <div class="row">
                    @foreach($permissions as $groupName => $permission)
                    <div class="col-5">
                        <h4>{{$groupName}}</h4>

                        <div>
                            @foreach($permission as $item)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input name="permission_ids[]" type="checkbox" class="form-check-input" value="{{$item->id}}">
                                    {{$item->display_name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-icon-text">
                <i class="typcn typcn-input-checked btn-icon-prepend"></i>
                Submit
            </button>

        </form>

    </div>
</div>

@endsection