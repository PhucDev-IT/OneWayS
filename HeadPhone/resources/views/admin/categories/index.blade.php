@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')
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
                            Icon
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

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    fetchData();

    function fetchData() {
        $('tbody').empty();
        $.ajax({
            url: '/api/fetch-categories',
            method: 'GET',
            dataType: "json",
            success: function(response) {
                hiddenLoadingPage();
                displayDataToView(response.categories.data);
                customPaginate(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function displayDataToView(categories) {
        $.each(categories, function(key, category) {
            $('tbody').append(`
                    <tr>
                        <td>
                           ${category.id}
                        </td>
                        <td>
                           
                        </td>
                        <td>
                            ${category.name}
                        </td>
                        <td>
                            ${category.products_count}
                        </td>
                        <td>
                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                      
                    </tr>
                `);
        });
    }

    function getDataByPage(url,active) {
        console.log(url)
        if(url==='null' || active === true) return

        showLoadingPage();

        $.ajax({
            type: 'GET',
            url: url,
            dataType: "json",
            success: function(response) {
                hiddenLoadingPage();
                displayDataToView(response.categories.data);
                customPaginate(response);
            }
        });
    }
</script>

@endsection