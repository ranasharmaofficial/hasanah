<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front_assets/img/favicon.png')}}">

    <!-- Font Awesome Icons CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/font-awesome.min.css')}}">
    <!-- Themify Icons CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/themify-icons.css')}}">
    <!-- Elegant Font Icons CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/elegant-font-icons.css')}}">
    <!-- Elegant Line Icons CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/elegant-line-icons.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/bootstrap.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/venobox/venobox.css')}}">
    <!-- OWL-Carousel CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/owl.carousel.css')}}">
    <!-- Slick Nav CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/slicknav.min.css')}}">
    <!-- Css Animation CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/css-animation.min.css')}}">
    <!-- Nivo Slider CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/nivo-slider.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/css/courses.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/css/responsive.css')}}">

    <script src="{{asset('front_assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
</head>

<body>
    @include('header')

    @yield('content')

   @include('footer')
   
   <a data-scroll href="#header" id="scroll-to-top"><i class="arrow_up"></i></a>

		<!-- jQuery Lib -->
		<script src="{{asset('front_assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{asset('front_assets/js/vendor/bootstrap.min.js')}}"></script>
		<!-- Tether JS -->
		<script src="{{asset('front_assets/js/vendor/tether.min.js')}}"></script>
        <!-- Imagesloaded JS -->
        <script src="{{asset('front_assets/js/vendor/imagesloaded.pkgd.min.js')}}"></script>
		<!-- OWL-Carousel JS -->
		<script src="{{asset('front_assets/js/vendor/owl.carousel.min.js')}}"></script>
		<!-- isotope JS -->
		<script src="{{asset('front_assets/js/vendor/jquery.isotope.v3.0.2.js')}}"></script>
		<!-- Smooth Scroll JS -->
		<script src="{{asset('front_assets/js/vendor/smooth-scroll.min.js')}}"></script>
		<!-- venobox JS -->
		<script src="{{asset('front_assets/js/vendor/venobox.min.js')}}"></script>
        <!-- ajaxchimp JS -->
        <script src="{{asset('front_assets/js/vendor/jquery.ajaxchimp.min.js')}}"></script>
        <!-- Counterup JS -->
		<script src="{{asset('front_assets/js/vendor/jquery.counterup.min.js')}}"></script>
        <!-- waypoints js -->
		<script src="{{asset('front_assets/js/vendor/jquery.waypoints.v2.0.3.min.js')}}"></script>
        <!-- Slick Nav JS -->
        <script src="{{asset('front_assets/js/vendor/jquery.slicknav.min.js')}}"></script>
        <!-- Nivo Slider JS -->
        <script src="{{asset('front_assets/js/vendor/jquery.nivo.slider.pack.js')}}"></script>
        <!-- YTPlayer JS -->
	    <script src="{{asset('front_assets/js/vendor/jquery.mb.YTPlayer.min.js')}}"></script>
        <!-- Wow JS -->
		<script src="{{asset('front_assets/js/vendor/wow.min.js')}}"></script>
		<!-- Contact JS -->
		<script src="{{asset('front_assets/js/contact.js')}}"></script>
		<!-- Main JS -->
		<script src="{{asset('front_assets/js/main.js')}}"></script>

    </body>
</html>