@extends('master')

@section('title')Register - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')

<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center my-5 mx-2">
            <div class="card col-md-6 mt-3" style="background-color: rgb(248, 246, 255); box-shadow: 4px 5px #c1c1c1;">
                <div class="contact-form card-body">
                    <h3 class="text-center p-0 m-0">Register your Account</h3>
                    <p>&nbsp;</p>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form action="{{route('studentRegister')}}" method="post" class="form-horizontal">
                        @csrf
                        <div class="colum-row row">
                            <div class="col-sm-6 form-group">
                                <input type="text" id="name" value="{{old('name')}}" name="name" class="form-control" placeholder="Name" required>
                                    <span class="form-text text-danger">@error('name')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email"
                                    required>
                                    <span class="form-text text-danger">@error('email')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="tel" id="mobile" value="{{old('mobile')}}" name="mobile" class="form-control" placeholder="Mobile" required>
                                    <span class="form-text text-danger"> @error('mobile'){{$message}} @enderror</span>
                            </div>
                            <div class="col-sm-6 form-group" id="otpget">
                                <button class="btn btn-info" onclick="getOTP()"><i class="fa fa-paper-plane"></i> Send OTP</button>
                            </div>
                            <div class="col-sm-6 form-group" id="otpinput" style="display: none;">
                                <input type="text" id="otp" value="{{old('otp')}}" name="otp" class="form-control" placeholder="Enter OTP" required>
                                <span class="form-text text-danger">@error('otp') {{$message}} @enderror</span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="password" id="password" style="display: none;" value="{{old('password')}}" name="password" class="form-control" placeholder="Password"
                                    required>
                                    <span class="form-text text-danger">@error('password')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="password" id="cpassword" style="display: none;" value="{{old('cpassword')}}" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                                    <span class="form-text text-danger">@error('cpassword')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="form-group col-md-12 text-center" id="mobiletakent" style="display: none;">
                            <span class="form-text text-danger" id="mobtaken"></span>
                        </div>
                        <div class="form-group col-md-12 text-center" id="registerButton" style="display: none;">
                            <button id="submit" style="cursor: pointer;" class="default-btn rounded" type="submit">REGISTER</button>
                        </div>
                        <div class="col-sm-12 text-center">
                            <a href="{{url('login')}}">Have you already account? Login Now</a>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script class="text/javascript">
    function getOTP(){
        let mob = document.getElementById('mobile').value;
        $.ajax({
            url: '{{route('getotp')}}',
            method: 'POST',
            data: 'mobile='+mob+'&_token={{csrf_token()}}',
            success:function(response){
                console.log(response);
                document.getElementById('otpget').style="display: none";
                document.getElementById('otpinput').style="display: block";
                document.getElementById('registerButton').style="display: block";
                document.getElementById('password').style="display: block";
                document.getElementById('cpassword').style="display: block";
                document.getElementById('mobiletakent').style="display: none";
            },
            error:function(errlog){
                let mss = JSON.parse(errlog.responseText);
                // console.log(mss.errors.mobile[0]);
                document.getElementById('otpget').style="display: block";
                document.getElementById('otpinput').style="display: none";
                document.getElementById('registerButton').style="display: none";
                document.getElementById('password').style="display: none";
                document.getElementById('cpassword').style="display: none";
                document.getElementById('mobiletakent').style="display: block";
                document.getElementById('mobtaken').innerHTML = mss.errors.mobile[0];
            }
        });
    }
</script>
@endsection