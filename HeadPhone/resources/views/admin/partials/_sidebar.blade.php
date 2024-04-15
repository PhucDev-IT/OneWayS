<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <div class="d-flex sidebar-profile">
        <div class="sidebar-profile-image">
          <img src="{{@Auth::user()->avatar}}" alt="image">
          <span class="sidebar-status-indicator"></span>
        </div>
        <div class="sidebar-profile-name">
          <p class="sidebar-name">
            {{@Auth::user()->name}}
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
      <a class="nav-link" href="{{route('dashboard.index')}}">
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
          <li class="nav-item"><a class="nav-link" href="">Cấu hình menu</a></li>
          <li class="nav-item"><a class="nav-link" href="">Cấu hình navbar</a></li>

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
          <li class="nav-item"><a class="nav-link" href="{{ route('banner') }}">Danh sách banner</a></li>
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
      <a class="nav-link" href="{{route('imports.index')}}">
        <i class="typcn typcn-download menu-icon"></i>
        <span class="menu-title">Nhập hàng</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('vouchers.index')}}">
        <i class="typcn typcn-tags menu-icon"></i>
        <span class="menu-title">Mã giảm giá</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link"  href="{{route('orders.index')}}" >
        <i class="typcn typcn-dropbox menu-icon"></i>
        <span class="menu-title">Đơn hàng</span>
      </a>

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
      <a class="nav-link" data-toggle="collapse" href="#ui-chart" aria-expanded="false" aria-controls="ui-chart">
      <i class="typcn typcn-chart-pie-outline menu-icon"></i>
        <span class="menu-title">Báo cáo - Thống kê</span>
        <i class="typcn typcn-chevron-right menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-chart">
        <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="{{route('admin.statistical.products')}}">Doanh thu sản phẩm</a></li>
          

        </ul>
      </div>
    </li>

   

  </ul>

</nav>