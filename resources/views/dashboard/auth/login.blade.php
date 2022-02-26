@extends('dashboard.auth.auth-master')
@section('title', 'Login')
@section('content')
<main role="main" class="ion-checkout">
    <div class="card mb-3">
       <div class="card-header font-weight-bold text-center">
           Student Login
       </div>
        <form action="#" method="post" class="p-2">
            <div class="ion-list ion-no-margin ion-no-padding">
            <div class="text-field">
                <input type="email" required/>
                <label>Enter Your Username <span class="danger">*</span></label>
            </div>
            </div>
            <div class="ion-list ion-no-margin">
            <div class="text-field">
                <input type="password" required/>
                <label>Enter Your Password<span class="danger">*</span></label>
            </div>
            </div>
        </form>
        <div class="p-3 border-top">
        <a href="#" class="btn btn-block btn-oringe ion-no-margin">Login Now</a>
        <div class="text-center mt-3">
            <a href="{{url('dashboard/auth/forget-password')}}" class="text-center mt-3">Forget Password?</a>
        </div>
        </div>       
    </div>
 </main>
@endsection