<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <div class="d-flex sidebar-profile">
        <div class="sidebar-profile-image">
          <img src="{{asset('admin/assets/images/faces/face29.png')}}" alt="image">
          <span class="sidebar-status-indicator"></span>
        </div>
        <div class="sidebar-profile-name">
          <p class="sidebar-name">
             Nguyễn Văn Phúc
          </p>
          <p class="sidebar-designation">
            Welcome
          </p>
        </div>
      </div>
      <div class="nav-search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
          <div class="input-group-append">
            <span class="input-group-text" id="search">
              <i class="typcn typcn-zoom"></i>
            </span>
          </div>
        </div>
      </div>
      <p class="sidebar-menu-title">Dash menu</p>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('dashboard')}}">
        <i class="typcn typcn-home menu-icon"></i>
        <span class="menu-title">Bảng điều khiển <span class="badge badge-primary ml-3">New</span></span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#configuration_page" aria-expanded="false" aria-controls="configuration_page">
        <i class="typcn typcn-spanner-outline menu-icon"></i>
        <span class="menu-title">Cấu hình</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="configuration_page">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Cấu hình chung</a></li>

        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#banner" aria-expanded="false" aria-controls="banner">
        <i class="typcn typcn-image-outline menu-icon"></i>
        <span class="menu-title">Banner</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="banner">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('banner_category.index') }}">Danh mục banner</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('banner.index') }}">Danh sách banner</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{route('products.index')}}">
        <i class=" typcn typcn-sort-alphabetically-outline menu-icon"></i>
        <span class="menu-title">Sản phẩm</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{route('categories.index')}}">
        <i class="typcn typcn-th-list menu-icon"></i>
        <span class="menu-title">Danh mục</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{route('vouchers.index')}}">
        <i class="typcn typcn-tags menu-icon"></i>
        <span class="menu-title">Mã giảm giá</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="typcn typcn-dropbox menu-icon"></i>
        <span class="menu-title">Đơn hàng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{route('orders.waiting_confirm')}}">Chờ xác nhận</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Chờ gói hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Đang giao hàng</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class=" typcn typcn-group menu-icon"></i>
        <span class="menu-title">Người dùng</span>
        <i class="typcn typcn-chevron-right menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">Users</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{route('roles.index')}}">Roles</a></li>

        </ul>
      </div>
    </li>


    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <i class="typcn typcn-chart-pie-outline menu-icon"></i>
        <span class="menu-title">Charts</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="typcn typcn-th-small-outline menu-icon"></i>
        <span class="menu-title">Tables</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <i class="typcn typcn-compass menu-icon"></i>
        <span class="menu-title">Icons</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="typcn typcn-user-add-outline menu-icon"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
        <i class="typcn typcn-globe-outline menu-icon"></i>
        <span class="menu-title">Error pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="error">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/documentation/documentation.html">
        <i class="typcn typcn-document-text menu-icon"></i>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
 
</nav>