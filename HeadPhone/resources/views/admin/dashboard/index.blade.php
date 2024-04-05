@extends('admin.layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<style>
  .main-panel {
    width: calc(100%) !important;
  }

  .small-box {
    border-radius: 2px;
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    padding: 10px;

  }

  .bg-aqua {
    background-color: #00c0ef !important;
  }

  .bg-green {
    background-color: #00a65a !important;
  }

  .bg-yellow {
    background-color: #f39c12 !important;
  }

  .bg-red {
    background-color: #dd4b39 !important;
  }

  .small-box p {
    font-size: 15px;
    font-weight: bold;
    color: #ffffff;
  }

  .small-box h3 {
    font-size: 38px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
    color: #ffffff;
  }

  .small-box>.small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    color: rgba(255, 255, 255, 0.8);
    display: block;
    z-index: 10;
    background: rgba(0, 0, 0, 0.1);
    text-decoration: none;
  }
</style>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>0</h3>
            <p>Đơn hàng mới</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>
            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>44</h3>
            <p>Người Dùng Mới</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>65</h3>
            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
    </div>

    <!-- Thống kê -->
    <div class="row">
      <canvas id="myChart" style="width:100%;height: 300px;"></canvas>
    </div>

    <div class="row  mt-3">
      <div class="col-xl-5 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Sessions by Channel</h4>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-lg-6">
                    <div id="circleProgress6" class="progressbar-js-circle rounded p-3"></div>
                  </div>
                  <div class="col-lg-6">
                    <ul class="session-by-channel-legend">
                      <li>
                        <div>Firewalls(3)</div>
                        <div>4(100%)</div>
                      </li>
                      <li>
                        <div>Ports(12)</div>
                        <div>12(100%)</div>
                      </li>
                      <li>
                        <div>Servers(233)</div>
                        <div>2(100%)</div>
                      </li>
                      <li>
                        <div>Firewalls(3)</div>
                        <div>7(100%)</div>
                      </li>
                      <li>
                        <div>Firewalls(3)</div>
                        <div>6(70%)</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Events</h4>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="d-flex justify-content-between mb-md-5 mt-3">
                      <div class="small">Critical</div>
                      <div class="text-danger small">Error</div>
                      <div class="text-warning small">Warning</div>
                    </div>
                    <canvas id="eventChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Device stats</h4>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="d-flex justify-content-between mb-4">
                      <div>Uptime</div>
                      <div class="text-muted">195 Days, 8 hours</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div>First Seen</div>
                      <div class="text-muted">23 Sep 2019, 2.04PM</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div>Collected time</div>
                      <div class="text-muted">23 Sep 2019, 2.04PM</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div>Memory space</div>
                      <div class="text-muted">168.3GB</div>
                    </div>
                    <div class="progress progress-md mt-4">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Sessions by Channel</h4>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="d-flex justify-content-between mb-4">
                      <div class="font-weight-medium">Empolyee Name</div>
                      <div class="font-weight-medium">This Month</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Connor Chandler</div>
                      <div class="small">$ 4909</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Russell Floyd</div>
                      <div class="small">$857</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Douglas White</div>
                      <div class="small">$612 </div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Alta Fletcher </div>
                      <div class="small">$233</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Marguerite Pearson</div>
                      <div class="small">$233</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Leonard Gutierrez</div>
                      <div class="small">$35</div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <div class="text-secondary font-weight-medium">Helen Benson</div>
                      <div class="small">$43</div>
                    </div>
                    <div class="d-flex justify-content-between">
                      <div class="text-secondary font-weight-medium">Helen Benson</div>
                      <div class="small">$43</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Sales Analytics</h4>
              <button type="button" class="btn btn-sm btn-light">Month</button>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="d-md-flex mb-4">
                  <div class="mr-md-5 mb-4">
                    <h5 class="mb-1"><i class="typcn typcn-globe-outline mr-1"></i>Online</h5>
                    <h2 class="text-primary mb-1 font-weight-bold">23,342</h2>
                  </div>
                  <div class="mr-md-5 mb-4">
                    <h5 class="mb-1"><i class="typcn typcn-archive mr-1"></i>Offline</h5>
                    <h2 class="text-secondary mb-1 font-weight-bold">13,221</h2>
                  </div>
                  <div class="mr-md-5 mb-4">
                    <h5 class="mb-1"><i class="typcn typcn-tags mr-1"></i>Marketing</h5>
                    <h2 class="text-warning mb-1 font-weight-bold">1,542</h2>
                  </div>
                </div>
                <canvas id="salesanalyticChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Card Title</h4>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <div class="mr-1">
                    <div class="text-info mb-1">
                      Total Earning
                    </div>
                    <h2 class="mb-2 mt-2 font-weight-bold">287,493$</h2>
                    <div class="font-weight-bold">
                      1.4% Since Last Month
                    </div>
                  </div>
                  <hr>
                  <div class="mr-1">
                    <div class="text-info mb-1">
                      Total Earning
                    </div>
                    <h2 class="mb-2 mt-2  font-weight-bold">87,493</h2>
                    <div class="font-weight-bold">
                      5.43% Since Last Month
                    </div>
                  </div>
                </div>
                <canvas id="barChartStacked"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">E-Commerce Analytics</h4>
            </div>
            <div class="row">
              <div class="col-lg-9">
                <div class="d-sm-flex justify-content-between">
                  <div class="dropdown">
                    <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text pl-0" type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Mon,1 Oct 2019 - Tue,2 Oct 2019
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton4" data-x-placement="top-start">
                      <h6 class="dropdown-header">Mon,17 Oct 2019 - Tue,25 Oct 2019</h6>
                      <a class="dropdown-item" href="#">Tue,18 Oct 2019 - Wed,26 Oct 2019</a>
                      <a class="dropdown-item" href="#">Wed,19 Oct 2019 - Thu,26 Oct 2019</a>
                    </div>
                  </div>
                  <div>
                    <button type="button" class="btn btn-sm btn-light mr-2">Day</button>
                    <button type="button" class="btn btn-sm btn-light mr-2">Week</button>
                    <button type="button" class="btn btn-sm btn-light">Month</button>
                  </div>
                </div>
                <div class="chart-container mt-4">
                  <canvas id="ecommerceAnalytic"></canvas>
                </div>
              </div>
              <div class="col-lg-3">
                <div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="text-success font-weight-bold">Inbound</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">Current</div>
                    <div class="text-muted">38.34M</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">Average</div>
                    <div class="text-muted">38.34M</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">Maximum</div>
                    <div class="text-muted">68.14M</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">60th %</div>
                    <div class="text-muted">168.3GB</div>
                  </div>
                </div>
                <hr>
                <div class="mt-4">
                  <div class="d-flex justify-content-between mb-3">
                    <div class="text-success font-weight-bold">Outbound</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">Current</div>
                    <div class="text-muted">458.77M</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">Average</div>
                    <div class="text-muted">1.45K</div>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <div class="font-weight-medium">Maximum</div>
                    <div class="text-muted">15.50K</div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">60th %</div>
                    <div class="text-muted">45.5</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Sale Analysis Trend</h4>
            </div>
            <div class="mt-2">
              <div class="d-flex justify-content-between">
                <small>Order Value</small>
                <small>155.5%</small>
              </div>
              <div class="progress progress-md  mt-2">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: 80%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="mt-4">
              <div class="d-flex justify-content-between">
                <small>Total Products</small>
                <small>238.2%</small>
              </div>
              <div class="progress progress-md  mt-2">
                <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="mt-4 mb-5">
              <div class="d-flex justify-content-between">
                <small>Quantity</small>
                <small>23.30%</small>
              </div>
              <div class="progress progress-md mt-2">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <canvas id="salesTopChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-8 d-flex grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between">
              <h4 class="card-title mb-3">Đơn hàng mới</h4>
            </div>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img class="img-sm rounded-circle mb-md-0 mr-2" src="images/faces/face30.png" alt="profile image">
                        <div>
                          <div> Company</div>
                          <div class="font-weight-bold mt-1">volkswagen</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      Budget
                      <div class="font-weight-bold  mt-1">$2322 </div>
                    </td>
                    <td>
                      Status
                      <div class="font-weight-bold text-success  mt-1">88% </div>
                    </td>
                    <td>
                      Deadline
                      <div class="font-weight-bold  mt-1">07 Nov 2019</div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img class="img-sm rounded-circle mb-md-0 mr-2" src="images/faces/face31.png" alt="profile image">
                        <div>
                          <div> Company</div>
                          <div class="font-weight-bold  mt-1">Land Rover</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      Budget
                      <div class="font-weight-bold  mt-1">$12022 </div>
                    </td>
                    <td>
                      Status
                      <div class="font-weight-bold text-success  mt-1">70% </div>
                    </td>
                    <td>
                      Deadline
                      <div class="font-weight-bold  mt-1">08 Nov 2019</div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img class="img-sm rounded-circle mb-md-0 mr-2" src="images/faces/face32.png" alt="profile image">
                        <div>
                          <div> Company</div>
                          <div class="font-weight-bold  mt-1">Bentley </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      Budget
                      <div class="font-weight-bold  mt-1">$8,725</div>
                    </td>
                    <td>
                      Status
                      <div class="font-weight-bold text-success  mt-1">87% </div>
                    </td>
                    <td>
                      Deadline
                      <div class="font-weight-bold  mt-1">11 Jun 2019</div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img class="img-sm rounded-circle mb-md-0 mr-2" src="images/faces/face33.png" alt="profile image">
                        <div>
                          <div> Company</div>
                          <div class="font-weight-bold  mt-1">Morgan </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      Budget
                      <div class="font-weight-bold  mt-1">$5,220 </div>
                    </td>
                    <td>
                      Status
                      <div class="font-weight-bold text-success  mt-1">65% </div>
                    </td>
                    <td>
                      Deadline
                      <div class="font-weight-bold  mt-1">26 Oct 2019</div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img class="img-sm rounded-circle mb-md-0 mr-2" src="images/faces/face34.png" alt="profile image">
                        <div>
                          <div> Company</div>
                          <div class="font-weight-bold  mt-1">volkswagen</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      Budget
                      <div class="font-weight-bold  mt-1">$2322 </div>
                    </td>
                    <td>
                      Status
                      <div class="font-weight-bold text-success mt-1">88% </div>
                    </td>
                    <td>
                      Deadline
                      <div class="font-weight-bold  mt-1">07 Nov 2019</div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com</a> 2020</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard </a>templates from Bootstrapdash.com</span>
    </div>
  </footer>
  <!-- partial -->
</div>
@endsection
@section('script')

<script>
  hiddenLoadingPage();
</script>

<script>
  let xValues = [];
  let yValues = [];

  $.ajax({
    type: 'GET',
    url: "{{route('dashboard.statisticalByYear')}}",
    dataType: 'json',
    success: function(response) {
      response.forEach(item => {
        xValues.push(item.month);
        yValues.push(item.revenue);
      });
      console.log(response);
      setToChart();
    }
  });


  function setToChart() {
    new Chart("myChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(0,0,255,1.0)",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        
      }
    });
  }
</script>
@endsection