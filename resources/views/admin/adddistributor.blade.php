@extends('admin.layouts.master')
@section('title','Add Distributor')
@section('content')
    
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 text-danger">@yield('title')</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Dashboard</a></li>
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
                    <div class="col-sm-12">
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
                    </div>
                    <form method="post" action="{{route('uploadDistributorData')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Personal Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="Company" class="col-form-label">Select Company <star>*</star></label>
                                    <select class="form-select" required type="text" name="company_id" id="Company">
                                        <option selected disabled value="">---Select Company---</option>
                                        @foreach ($companydata as $citem)
                                            <option value="{{$citem->company_id}}">{{$citem->company_name}}</option>                                            
                                        @endforeach
                                    </select>
                                    <small class="form-text text-danger">@error('company_id') This field is required. @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="fullname" class="col-form-label">Full Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="name" value="{{old('fullname')}}" placeholder="Enter Full Name" id="fullname">
                                    <small class="form-text text-danger">@error('name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="dob" class="col-form-label">Date of Birth <star>*</star></label>
                                    <input class="form-control" type="date" required name="dob" value="{{old('dob')}}" id="dob">
                                    <small class="form-text text-danger">@error('dob') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="Gender" class="col-form-label">Gender <star>*</star></label>
                                    <select id="BatchTiming" name="gender" required class="form-select" aria-label="Select Gender">
                                        <option disabled selected value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                    <small class="form-text text-danger">@error('gender') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="aadharNumber" class="col-form-label">Aadhar Card (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="aadhar_card" id="aadharNumber">
                                    <small class="form-text text-danger">@error('aadhar_card') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="panNo" class="col-form-label">Pan Card (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="pan_card" id="panNo">
                                    <small class="form-text text-danger">@error('pan_card') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="voterid" class="col-form-label">Voter Id (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="voter_id" id="voterid">
                                    <small class="form-text text-danger">@error('voter_id') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Contact Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="landmark" class="col-form-label">Landmark <star>*</star></label>
                                    <input class="form-control" required name="landmark" value="{{old('landmark')}}" placeholder="Landmark" id="landmark" />
                                    <small class="form-text text-danger">@error('landmark') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="country" class="col-form-label">Country <star>*</star></label>
                                    <select class="form-control" required name="country" id="country">
                                        <option value="India">India</option>
                                    </select>
                                    <small class="form-text text-danger">@error('country') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="listBox" class="col-form-label">State <star>*</star></label>
                                    <select class="form-control" required name="state" id="listBox" onchange='selct_district(this.value)'></select>
                                    <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="secondlist" class="col-form-label">City <star>*</star></label>
                                    <select class="form-select" required name="city" id='secondlist'></select>
                                    <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="pincode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" required type="tel" name="pincode" value="{{old('pincode')}}" placeholder="Enter Pin code" id="pincode">
                                    <small class="form-text text-danger">@error('pincode') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" required type="tel" name="mobile_no" value="{{old('mobile_no')}}" placeholder="Enter Mobile No." id="mobileNumber">
                                    <small class="form-text text-danger">@error('mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers <star>*</star></label>
                                    <input class="form-control" type="tel" name="alt_mobile_no" value="{{old('alt_mobile_no')}}" placeholder="Enter Alt. Mobile No." id="AltMobile">
                                    <small class="form-text text-danger">@error('alt_mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" required type="email" name="email" value="{{old('email')}}" placeholder="Enter Email" id="email">
                                    <small class="form-text text-danger">@error('email') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Photo <star>*</star></label>
                                    <input class="form-control" type="file" accept="image/*" name="photo" id="file">
                                    <small class="form-text text-danger">@error('photo') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-12 text-center mt-3">
                                    <button name="add_distributor" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Distributor Data</button>    
                                </div>                                
                            </div>
                        </div>                         
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
