@extends('distributor.layouts.master')
@section('title','My Profile')
@section('content')
 <div class="page-content">
    <div class="container-fluid">
         <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">@yield('title')</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{'home'}}">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                         <div class="dastone-profile">
                            <div class="row">
                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                    <div class="dastone-profile-main">
                                        <div class="dastone-profile-main-pic">
                                            <img src="{{asset('uploads/documents/'.$distributordetails['distributor_photo'])}}" alt="" height="110" class="rounded-circle">
                                            <span class="dastone-profile_main-pic-change">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">Name:&nbsp;{{$distributordata->name}}</h5>                                                        
                                            <p class="mb-0 dastone-user-name-post">User Id:&nbsp;{{$distributordata->user_id}}</p>                                                        
                                        </div>
                                    </div>                                                
                                </div><!--end col-->
                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : +91 {{$distributordata->mobile}}</li>
                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{$distributordata->email}}</li>
                                    </ul>
                                   
                                </div><!--end col-->
                            </div><!--end row-->

                        </div><!--end f_profile-->   

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-info">Profile Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td class="text-right">{{$distributordata->name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td class="text-right">{{$distributordata->mobile}}</td>
                                </tr>
                                <tr>
                                    <td>Alternate Mobile</td>
                                    <td class="text-right">{{$distributordetails->altMobile}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="text-right">{{$distributordata->email}}</td>
                                </tr>
                                <tr>
                                    <td>Aadhar Number</td>
                                    <td class="text-right">{{$distributordetails->aadharNumber}}</td>
                                </tr>
                                <tr>
                                    <td>Pan Number</td>
                                    <td class="text-right">{{$distributordetails->panNumber}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-right">{{$distributordetails->landmark}}, {{$distributordetails->city}}, {{$distributordetails->state}} - {{$distributordetails->pincode}}</td>
                                </tr>
                            </tbody>
                        </table>   

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
