@extends('admin.layouts.app')

@section('title', 'Users')
@section('content')



<div class="card">
    <div class="card-body">
        <h4 class="card-title">Danh sách sản phẩm đang kinh doanh</h4>
        <form action="{{ route('products.search') }}" method="get">
            @csrf
        
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm mới</a>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Nhập tên sản phẩm cần tìm" aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 text-right">
                    <select class="form-control" name="category">
                        <option value="0" selected>Tất cả</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </form>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Tên Sản Phẩm
                        </th>
                        <th>
                            Đơn giá
                        </th>
                        <th>
                            Sale
                        </th>

                        <th>Rate</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            {{$product->id}}
                        </td>
                        <td>
                            <img src="{{ asset('storage/uploads/'.$product->img_preview)}}" alt="Demo" width="200">
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                            <span class="text-danger">{{$product->price}} </span>
                        </td>
                        <td>
                            <span class="text-danger">{{$product->sale}}</span>
                        </td>
                        <td>{{$product->rate}}</td>
                        <td>
                            <a href="{{route('products.edit',$product->id)}}" style="margin-right: 10px;"><i class="fa-solid fa-pen-to-square" style="color: #29ff1a;"></i></a>
                            <span id="btn-remove" onclick="showModelConfirm(this)" data-id="{{$product->id}}"> <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></span>
                            <form action="{{route('products.destroy',$product->id)}}" id="form-delete{{$product->id}}" method="post">
                                @csrf
                                @method('delete')

                            </form>


                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
</div>


@endsection