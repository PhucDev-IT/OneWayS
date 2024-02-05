@extends('admin.layouts.app')

@section('title', 'Users')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Quản lý danh mục sản phẩm</h4>
        <div><a href="{{route('categories.create')}}" class="btn btn-primary">Thêm mới</a></div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Tên danh mục
                        </th>
                        <th>
                            Số lượng sản phẩm
                        </th>
                        <th>
                            Action
                        </th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $item)
                    <tr>
                        <td>
                            {{$item->id}}
                        </td>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                           {{$item->products_count}}
                        </td>
                        <td>
                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
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