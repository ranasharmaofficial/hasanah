<!doctype html>
<html lang="en">
    <head>        
        <meta charset="utf-8" />
        <title>Employee Login | Hasanah Gilrs College</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Themesdesign" name="Webfinic" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets_admin/images/favicon.ico')}}" />

        <!-- Bootstrap Css -->
        <link href="{{asset('assets_admin/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets_admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets_admin/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets_admin/css/custom_register.css')}}" id="app-style" rel="stylesheet" type="text/css" />
<style>
    body
    {
        overflow-x: hidden;
    }
</style>
    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div class="mt-5">
                                                    <a href="{{url('')}}" class="logo"><img src="{{asset('assets_admin/images/logo-light.png')}}" style="max-height:100px;" alt="Hasanah Girls College"></a>
                                                </div>
                                                 <h4 class="font-size-18 mt-4">Login !</h4>
                                            </div>

                                            <div class="p-2 mt-2">
                                                <form class="form" action="{{route('employee.login')}}" method="POST">   
                                                    @csrf
                                                    <div class="flash-message">
                                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                            @if (Session::has('alert-' . $msg))
                                                                <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                                                    {{ Session::get('alert-' . $msg) }}
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>   
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-user-2-fill auti-custom-input-icon"></i>
                                                                <label for="userusername">Username</label>
                                                                <input type="username" name="username" class="form-control" id="userusername" required placeholder="Enter username">
                                                                <small class="form-text text-danger">@error('username') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                                <label for="userpassword">Password</label>
                                                                <input type="password" name="password" class="form-control" id="userpassword" required placeholder="Enter password">
                                                                <small class="form-text text-danger">@error('password') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" checked id="customControlInline">
                                                        <label class="form-check-label" for="customControlInline">Agree Terms & Conditions</label>
                                                    </div>

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Login</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            <div class="mt-5 text-center">
                                                
                                                <p>© <script>document.write(new Date().getFullYear())</script> Hasanah Girls College. Crafted with <i class="mdi mdi-heart text-danger"></i> by Webfinic</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="authentication-bg">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="register_heading">Welcome to <br>Hasanah Educational Trust</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets_admin/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets_admin/js/app.js')}}"></script>

    </body>
</html>
