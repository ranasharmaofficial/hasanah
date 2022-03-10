@extends('admin.layouts.master')
@section('title','View Distributor')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Distributor</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        
		@if ($flag)
       <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                         <div class="dastone-profile">
                            <div class="row">
                                <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                    <div class="dastone-profile-main">
                                        <div class="dastone-profile-main-pic">
                                            <img src="{{asset('uploads/documents/'.$distributordata->employee_photo	)}}" alt="" height="110" class="rounded-circle">
                                            <span class="dastone-profile_main-pic-change">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">{{$userdata->name}}</h5>                                                        
                                            <p class="mb-0 dastone-user-name-post">Employee Code: {{$userdata->user_id}}</p>                                                        
                                        </div>
                                    </div>                                                
                                </div><!--end col-->
                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : +91 {{$userdata->mobile}}</li>
                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{$userdata->email}}</li>
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
                                    <td>Employee Code</td>
                                    <td class="text-right">{{$userdata->user_id}}</td>
                                </tr>
                                <tr>
                                    <td>Qualification</td>
                                    <td class="text-right">{{$distributordata->qualification}}</td>
                                </tr>
                                <tr>
                                    <td>Experience</td>
                                    <td class="text-right">{{$distributordata->experience}}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td class="text-right">{{$distributordata->dob}}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td class="text-right">{{$distributordata->gender}}</td>
                                </tr>
                                <tr>
                                    <td>Aadhar Number</td> 
                                    <td class="text-right"><a class="btn btn-info btn-sm" target="_blank" href="{{asset('uploads/documents/'.$distributordata->aadhar_card)}}">View Aadhar Card</a></td>
                                </tr>
                                <tr>
                                    <td>Pan Number</td>
                                    <td class="text-right"><a class="btn btn-info btn-sm" target="_blank" href="{{asset('uploads/documents/'.$distributordata->pan_card)}}">View Pan Card</a></td>
                                </tr>
                                <tr>
                                    <td>Voter Id</td>
                                    <td class="text-right"><a class="btn btn-info btn-sm" target="_blank" href="{{asset('uploads/documents/'.$distributordata->voter_id)}}">View VoterId Card</a></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-right">{{$distributordata->landmark}}, {{$distributordata->city}}, {{$distributordata->state}} - {{$distributordata->pincode}}, {{$distributordata->country}}</td>
                                </tr>  
                            </tbody>
                        </table>   

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
		@else
		<div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.view-distributor')}}" class="row" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="Distributorcode">Distributor Code <star>*</star></label>
                                    <input class="form-control" id="Distributorcode" required type="text" name="distributorcode" />
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
		 @endif
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection