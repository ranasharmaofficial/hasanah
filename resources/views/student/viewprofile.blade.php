@extends('user.layouts.master')
@section('title','My Profile')
@section('content')
 <div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 img_com">
                            <img src="{{asset('uploads/company-logo/'.$companydata->logo)}}" alt="" class="img-thumbnail imagefix">
                        </div>
                        <div class="col-sm-8">
                            <h4 class="dist_companyname text-primary">{{$companydata->company_name}}</h4>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title align-items-right text-right">
                        <h4 class="text-right">Designation :<span class="text-primary"> Contractor</span></h4>
                        <h4 class="">Last Login at :<span class="text-primary"> {{$lastLoginTime->created_at}}</span></h4>
                        <h4 class="mt-1">Name : <span class="text-primary"> {{ $LoggedContractInfo['name'] }}</span</h4>
                        <h4 class="mt-1">User Id :<span class="text-primary">  {{ $LoggedContractInfo['user_id'] }}</span</h4>
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
                                            <img src="{{asset('uploads/contractor/'.$contractorData['photo'])}}" alt="" height="110" class="rounded-circle">
                                            <span class="dastone-profile_main-pic-change">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">Name:&nbsp;{{$userData->name}}</h5>                                                        
                                            <p class="mb-0 dastone-user-name-post">User Id:&nbsp;{{$userData->user_id}}</p>                                                        
                                        </div>
                                    </div>                                                
                                </div><!--end col-->
                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : +91 {{$userData->mobile}}</li>
                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{$userData->email}}</li>
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
                                    <td class="text-right">{{$userData->name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td class="text-right">{{$userData->mobile}}</td>
                                </tr>
                                <tr>
                                    <td>Alternate Mobile</td>
                                    <td class="text-right">{{$contractorData->altMobile}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="text-right">{{$userData->email}}</td>
                                </tr>
                                <tr>
                                    <td>Aadhar Number</td>
                                    <td class="text-right">{{$contractorData->aadharNumber}}</td>
                                </tr>
                                <tr>
                                    <td>Pan Number</td>
                                    <td class="text-right">{{$contractorData->panNumber}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-right">{{$contractorData->landmark}}, {{$contractorData->city}}, {{$contractorData->state}} - {{$contractorData->pincode}}</td>
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
