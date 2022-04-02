<!doctype html>
<html lang="en">
    <head>        
        <meta charset="utf-8" />
        <title>Register | Hasanah Gilrs College</title>
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
    .processing{
        font-weight: 600;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>
    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="authentication-bg">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="register_heading">Welcome to <br>Hasanah Girls College</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div class="mt-5">
                                                    <a href="{{url('')}}" class="logo"><img src="{{asset('assets_admin/images/logo-light.png')}}" style="max-height:100px;" alt="Hasanah Girls College"></a>
                                                </div>
                                                 <h4 class="font-size-18 mt-3">Register Now</h4>
                                            </div>

                                            <div class="p-2 mt-2">
                                                <form class="form" action="{{route('user.registration')}}" method="POST"> 
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
                                                    @csrf 
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-community-fill auti-custom-input-icon"></i>
                                                                <label for="selectcompany">Select Company</label>
                                                                <select class="form-control" required name="company_id" id="selectcompany">
                                                                    <option value="" selected disabled>---Select Company---</option>
                                                                    @foreach ($companydata as $citem)
                                                                        <option value="{{$citem->company_id}}">{{$citem->company_name}}</option>                                            
                                                                    @endforeach
                                                                </select>
                                                                <small class="form-text text-danger">@error('company_id') Project category name is required. @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" autofocus="true" class="form-control" id="name" required placeholder="Enter username" value="{{old('username')}}">
                                                                <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-phone-line auti-custom-input-icon"></i>
                                                                <label for="usermobile">Mobile</label>
                                                                <input type="tel" name="mobile" class="form-control" id="usermobile" required placeholder="Enter mobile">
                                                                <small class="form-text text-danger">@error('mobile') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-mail-line auti-custom-input-icon"></i>
                                                                <label for="useremail">Email</label>
                                                                <input type="email" name="email" class="form-control" id="useremail" required placeholder="Enter email">
                                                                <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-home-7-line auti-custom-input-icon"></i>
                                                                <label for="useraddress">Address</label>
                                                                <input type="text" name="address" class="form-control" id="useraadharnumber" required placeholder="Enter address">
                                                                <small class="form-text text-danger">@error('address') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                                <label for="userpassword">New Password</label>
                                                                <input type="password" name="password" class="form-control" id="userpassword" required placeholder="Enter New Password">
                                                                <small class="form-text text-danger">@error('password') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3 auth-form-group-custom mb-4">
                                                                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                                <label for="confirmpassword">Confirm Password</label>
                                                                <input type="password" name="confirm_password" class="form-control" id="confirmpassword" required placeholder="Enter Confirm Password">
                                                                <small class="form-text text-danger">@error('confirm_password') {{ $message }} @enderror</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 d-none" id="selecategory">
                                                            <p class="p-0 m-0 processing d-none text-primary" id="processing">Processing...</p>
                                                            <label for="selectcategory">Select Category</label>
                                                            <div class="row" id="categorylist"></div>
                                                        </div>
                                                    </div>
                                                </br>
                                                </br>
                                                    <div class="form-check">
                                                        <input type="checkbox" checked class="form-check-input" id="customControlInline">
                                                        <label class="form-check-label" for="customControlInline">I accept all terms & conditions.</label>
                                                    </div>
                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                                        <p class="p-0 mt-4">Already have an account ? <a href="{{url('user/login')}}" class="fw-medium text-primary"> Login </a> </p>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="text-center">                                                
                                                <p>© <script>document.write(new Date().getFullYear())</script> Hasanah Girls College. Crafted with <i class="mdi mdi-heart text-danger"></i> by Webfinic</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        {{-- <script src="{{asset('assets_admin/libs/jquery/jquery.min.js')}}"></script> --}}
        {{-- <script src="{{asset('assets_admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets_admin/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets_admin/js/app.js')}}"></script> --}}
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function(){
        jQuery('#selectcompany').change(function(){
            let datas = "";
            let cid=jQuery(this).val();
            // console.log(cid)
            // $('#selecategory').empty();
            $('#processing').removeClass("d-none");
            $('#processing').addClass("d-block");
            jQuery.ajax({
                url:'{{url('getcategoryname')}}',
                type:'post',
                data:'companyid='+cid+'&_token={{csrf_token()}}',
                success:function(result){
                    // console.log(result);
                    if (result == '') {
                        datas += '<div class="col-sm-12"><div class="alert alert-danger">Not found. Please! select other company.</div></div>';
                    } else{
                        // console.log(result);
                        $.each(result, function (i) {
                            datas += '<div class="col-sm-4"><div class="form-check"><input type="checkbox" name="categoryselect" class="form-check-input" id="'+result[i].project_cat_id+'" onClick="webfinicChange(this)" value="'+result[i].project_cat_id+'"><label class="form-check-label" for="'+result[i].project_cat_id+'">'+result[i].project_category+'</label></div></div>';
                            // console.log(result);
                        });                    
                    }
                    jQuery('#categorylist').html(datas);
                    jQuery('#selecategory').addClass("d-block");
                    jQuery('#selecategory').removeClass("d-none");
                    $('#processing').addClass("d-none");
                }
            });
        });
    });
</script>
<script>
    function webfinicChange(webfinicType){
        var webfinicName = document.getElementsByName(webfinicType.name);
        var checked = document.getElementById(webfinicType.id);
    
        if (checked.checked) {
            for(var i=0; i < webfinicName.length; i++){
    
                if(!webfinicName[i].checked){
                    webfinicName[i].disabled = true;
                }else{
                    webfinicName[i].disabled = false;
                }
            } 
        }
        else {
            for(var i=0; i < webfinicName.length; i++){
            webfinicName[i].disabled = false;
            } 
        }    
    }
</script>
    </body>
</html>
