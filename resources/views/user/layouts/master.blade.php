<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') - Hasanah Girls College User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesdesign" name="Webfinic" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets_admin/images/favicon.png')}}">
    <!-- Lightbox css -->
    <link href="{{asset('assets_admin/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{asset('assets_admin/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets_admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets_admin/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link href="{{asset('assets_admin/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <script language="Javascript" src="{{asset('assets_admin/images/search/jquery.js')}}"></script>
    <script type="text/JavaScript" src='{{asset('assets_admin/images/search/state.js')}}'></script>
<style>
    .userbackcolor{
        background-color:#5D327B!important;
    }
    .usernavbar{
        background-color:#5D327B!important;
    }
    body{
        background-color:#E8F8F5;
    }
</style>
@cloudinaryJS
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('user.header')
        @include('user.left-sidebar')

        
        <div class="main-content" id="result">
            @yield('content')
        </div>
        @include('user.footer')
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- JAVASCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('assets_admin/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets_admin/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets_admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets_admin/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets_admin/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
    <!-- App js -->
    <script src="{{asset('assets_admin/js/app.js')}}"></script>
    <script src="{{asset('assets_admin/js/ajax.js')}}"></script>
     <!--tinymce js-->
    <script src="{{asset('assets_admin/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets_admin/js/form-editor.init.js')}}"></script>
    <script src="{{asset('assets_admin/js/pages/lightbox.init.js')}}"></script>
    <script src="{{asset('assets_admin/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
</body>

</html>