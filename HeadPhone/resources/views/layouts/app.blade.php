<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>  @yield('title','Trang chủ')</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}}" />
	
	

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/slick.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/slick-theme.css')}}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/nouislider.min.css')}}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{asset('client/css/font-awesome.min.css')}}">



	<!-- Owl carousel css -->
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/owl.carousel.min.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/owl.theme.default.min.css')}}" />

	<!-- LAYOUT CSS-->
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/header.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/footer.css')}}" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/style.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('client/css/home.css')}}" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	@include('partials/header')
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	@include('partials/_navigation')
	<!-- /NAVIGATION -->

	@yield('content')

	<!-- FOOTER -->
	@include('partials/footer')
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{asset('client/js/jquery.min.js')}}"></script>
	<script src="{{asset('client/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('client/js/slick.min.js')}}"></script>
	<script src="{{asset('client/js/nouislider.min.js')}}"></script>
	<script src="{{asset('client/js/jquery.zoom.min.js')}}"></script>
	<script src="{{asset('client/js/main.js')}}"></script>

	<script src="{{asset('client/js/home/aos.js')}}"></script>

	{{-- OWL CAROUSEL JS --}}
	<script src="{{asset('client/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('client/js/home/default.js')}}"></script>
 
	@yield('script')
</body>

</html>