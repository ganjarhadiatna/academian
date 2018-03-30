<!DOCTYPE html>
<html>
<head>
	<title>Academian - @yield('title')</title>
	<meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link href="{{ asset('img/P/4.png') }}" rel='SHORTCUT ICON'/>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css/fontawesome-all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/assets.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/body.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/sign.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/guess.css') }}">

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
</head>
<body>
	<div id="header">
		<div class="place">
			<div class="menu col-full">
				<div class="pos lef">
					<a href="{{ url('/') }}">
						<div class="logo">
							Academian
						</div>
					</a>
				</div>
				<div class="pos mid"></div>
				<div class="pos rig">
					<a href="{{ url('/login') }}">
						<button class="create btn btn-black2-color ctn-up" id="compose">
							<span class="ttl-post">Login</span>
						</button>
					</a>
					<a href="{{ url('/register') }}">
						<button class="create btn btn-main2-color ctn-up" id="compose">
							<span class="ttl-post">Register</span>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div>
		@yield("content")
	</div>
	<div class="bdr-top">
		<div class="footer">
			<ul>
				<a href="#">
					<li>Home</li>
				</a>
				<a href="#">
					<li>About Us</li>
				</a>
				<a href="#">
					<li>Terms & Privace</li>
				</a>
				<a href="#">
					<li>Policy</li>
				</a>
				<a href="#">
					<li>Jobs</li>
				</a>
				<a href="#">
					<li>Help</li>
				</a>
			</ul>
		</div>
	</div>
</body>
</html>