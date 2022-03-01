@extends('admin.layouts.master')
@section('title','Add Employee')
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
                    <form method="post" action="{{route('addEmployee')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Personal Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="fullname" class="col-form-label">Full Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="name" placeholder="Full Name Name" id="fullname">
                                    <small class="form-text text-danger">@error('name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="qualification" class="col-form-label">Qualification <star>*</star></label>
                                    <input class="form-control" required type="text" name="qualification" placeholder="Qualification" id="qualification">
                                    <small class="form-text text-danger">@error('qualification') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="experience" class="col-form-label">Total Experience <star>*</star></label>
                                    <select class="form-select" required type="text" name="experience" id="experience">
                                        <option value="0">0 Year</option>
                                        <option value="1">1 Year</option>
                                        <option value="2">2 Year</option>
                                        <option value="3">3 Year</option>
                                        <option value="4">4 Year</option>
                                        <option value="5">5 Year</option>
                                        <option value="6">6 Year</option>
                                        <option value="7">7 Year</option>
                                        <option value="8">8 Year</option>
                                        <option value="9">9 Year</option>
                                        <option value="10+">10 Year +</option>
                                    </select>
                                    <small class="form-text text-danger">@error('experience') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="dob" class="col-form-label">Date of Birth <star>*</star></label>
                                    <input class="form-control" type="date" required name="dob" placeholder="" id="dob">
                                    <small class="form-text text-danger">@error('dob') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="Gender" class="col-form-label">Gender <star>*</star></label>
                                    <select id="BatchTiming" name="gender" required class="form-select" aria-label="Select Gender">
                                        <option disabled selected="">Select Gender</option>
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
                                    <label for="Voter" class="col-form-label">Voter Id (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="voter_id" id="Voter">
                                    <small class="form-text text-danger">@error('voter_id') {{$message}} @enderror</small>
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Contact Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="landmark" class="col-form-label">Landmark<star>*</star></label>
                                    <input class="form-control" required type="text" name="landmark" placeholder="Landmark" id="landmark" />
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
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" required type="tel" name="pincode" placeholder="Enter Pin code" id="PinCode">
                                    <small class="form-text text-danger">@error('pincode') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" required type="tel" name="mobile_no" placeholder="Enter Mobile No." id="mobileNumber">
                                    <small class="form-text text-danger">@error('mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers (Optional)</label>
                                    <input class="form-control" type="tel" name="alt_mobile_no" placeholder="Enter Alt. Mobile No." id="AltMobile">
                                    <small class="form-text text-danger">@error('alt_mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" required type="email" name="email" placeholder="Enter Email" id="email">
                                    <small class="form-text text-danger">@error('email') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Passport Size Photo <star>*</star></label>
                                    <input class="form-control" type="file" accept="image/*" name="photo" required id="file">
                                    <small class="form-text text-danger">@error('photo') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-12 text-center mt-2">
                                    <button name="add_employee" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Upload Data</button>    
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
