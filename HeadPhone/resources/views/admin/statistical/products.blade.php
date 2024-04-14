@extends('admin.layouts.app')

@section('title', 'Thống kê doanh thu sản phẩm')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Doanh thu sản phẩm</h4>
        <div>

            <div class="row">
                <div class="col-md-3">

                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Nhập tên sản phẩm cần tìm" aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" onclick="search()" type="submit">Search</button>
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

        </div>
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
                            Tổng doanh thu
                        </th>

                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="{{ asset('storage/uploads/'.$product->img_preview)}}" alt=""></td>
                        <td>{{$product->name}}</td>
                        <td><span style="font-weight: 500; color: red;">{{ number_format($product->total_sales, 0, ',', '.') }}đ</span></td>
                        <td>
                            <a class="edit" onclick="return callApiStatistical(`{{$product->id}}`);  return false;" data-toggle="modal" data-target="#myModal">
                                <i class="typcn typcn-chart-pie"></i>
                                Biểu đồ
                            </a>
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

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết thống kê theo phân loại</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/assets/js/public-js.js') }}"></script>
<script>
    $(document).ready(function() {
        hiddenLoadingPage();
    });

    function callApiStatistical(id) {
        $.ajax({
            type: 'get',
            url: "{{route('admin.statistical.piechart')}}",
            data: {
                id
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                let xValues = [];
                let yValues = [];
                $.each(response, function(index, data) {
                    xValues = [...xValues, data.color];
                    yValues = [...yValues, data.total_sales];
                });

                displayChart(xValues, yValues);

            },
            error: function(xhr, err) {
                console.log("Lỗi: " + err);
            }
        });
    }

    var formattedYValues = yValues.map(function(value) {
        return formatCurrency(value);
    });

    function displayChart(xValues, yValues) {

        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Doanh thu sản phẩm"
                },


            }
        });
    }
</script>

@endsection