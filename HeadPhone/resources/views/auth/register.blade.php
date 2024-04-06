<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng ký</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/typicons.font/font/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('admin/assets/images/logo.svg')}}" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form method="POST" class="pt-3" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name">

                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                </div>
                <div class="form-group">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.html" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin/assets/js/template.js')}}"></script>
  <script src="{{asset('admin/assets/js/settings.js')}}"></script>
  <script src="{{asset('admin/assets/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

</html>