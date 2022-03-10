@extends('admin.layouts.master')
@section('title','View Company')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Company</a></li>
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
                                            <img src="{{asset('uploads/company-logo/'.$companydata->logo)}}" alt="" height="110" class="rounded-circle">
                                            <span class="dastone-profile_main-pic-change">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                        </div>
                                        <div class="dastone-profile_user-detail">
                                            <h5 class="dastone-user-name">{{$companydata->company_name}}</h5>                                                        
                                            <p class="mb-0 dastone-user-name-post">Registeration Number: {{$companydata->registration_number}}</p>                                                        
                                        </div>
                                    </div>                                                
                                </div><!--end col-->
                                <div class="col-lg-4 ms-auto align-self-center">
                                    <ul class="list-unstyled personal-detail mb-0">
                                        <li class=""><i class="ti ti-mobile me-2 text-secondary font-16 align-middle"></i> <b> Phone </b> : +91 {{$companydata->mobile}}</li>
                                        <li class="mt-2"><i class="ti ti-email text-secondary font-16 align-middle me-2"></i> <b> Email </b> : {{$companydata->email}}</li>
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
                                    <td>Company Id</td>
                                    <td class="text-right">{{$companydata->company_id}}</td>
                                </tr>
                                <tr>
                                    <td>Registration Number</td>
                                    <td class="text-right">{{$companydata->registration_number}}</td>
                                </tr>
                                <tr>
                                    <td>Company Name</td>
                                    <td class="text-right">{{$companydata->company_name}}</td>
                                </tr>
                                <tr>
                                    <td>Pan Number</td>
                                    <td class="text-right">{{$companydata->pan_number}}</td>
                                </tr>
                                <tr>
                                    <td>Gst Number</td>
                                    <td class="text-right">{{$companydata->gst_number}}</td>
                                </tr>
                                <tr>
                                    <td>Owner Name</td>
                                    <td class="text-right">{{$companydata->owner_name}}</td>
                                </tr>
                                <tr>
                                    <td>Company Name</td>
                                    <td class="text-right">{{$companydata->company_name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td class="text-right">{{$companydata->mobile}}</td>
                                </tr>
                                <tr>
                                    <td>Alt. Mobile</td>
                                    <td class="text-right">{{$companydata->alt_mobile}}</td>
                                </tr>
                                 <tr>
                                    <td>Email</td>
                                    <td class="text-right">{{$companydata->email}}</td>
                                </tr>
                               <tr>
                                    <td>Established Date</td>
                                    <td class="text-right">{{$companydata->established_at}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-right">{{$companydata->landmark}}, {{$companydata->city}}, {{$companydata->state}} - {{$companydata->pincode}}, {{$companydata->country}}</td>
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
                        <form method="POST" action="{{route('admin.viewcompany')}}" class="row" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="Company">Company Code <star>*</star></label>
                                    <input class="form-control" id="Company" required type="text"
                                         name="company_id" />
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