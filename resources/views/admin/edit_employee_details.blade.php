@extends('admin.layouts.master')
@section('title','Edit Employee Details')
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
                        <div class="flash-message p-2">
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
                    <form method="post" action="{{route('admin.updateEmployeeDetails')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Personal Details:-</h4><hr>
                        <input type="hidden" name="employee_id" value="{{ $employeedata->employee_id }}">
                        <input type="hidden" required name="user_id" value="{{ $employeedata->user_id }}">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="Company" class="col-form-label">Select Company <star>*</star></label>
                                    <select class="form-select" required type="text" name="company_id" id="Company">
                                        <option selected disabled value="">---Select Company---</option>
                                        @foreach ($companylist as $citem)
                                            <option @if($citem->company_id==$employeedata->company_id) selected @endif value="{{$citem->company_id}}">{{$citem->company_name}}</option>                                            
                                        @endforeach
                                    </select>
                                    <small class="form-text text-danger">@error('company_id') This field is required. @enderror</small>
                                </div>
                               
                                <div class="col-sm-4">
                                    <label for="fullname" class="col-form-label">Employee Code </label>
                                    <input class="form-control" type="text" required value="{{ $userdata->user_id }}" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label for="fullname" class="col-form-label">Password </label>
                                    <input class="form-control" type="text"  name="password" required value="{{ $userdata->password }}">
                                    <small class="form-text text-danger">@error('password') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="fullname" class="col-form-label">Full Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="name" value="{{ $userdata->name }}" placeholder="Full Name Name" id="fullname">
                                    <small class="form-text text-danger">@error('name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="qualification" class="col-form-label">Qualification <star>*</star></label>
                                    <input class="form-control" required type="text" value="{{ $employeedata->qualification }}" name="qualification" placeholder="Qualification" id="qualification">
                                    <small class="form-text text-danger">@error('qualification') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="experience" class="col-form-label">Total Experience <star>*</star></label>
                                    <select class="form-select" required type="text" name="experience" id="experience">
                                        <option value="{{ $employeedata->experience }}" selected>{{ $employeedata->experience }} Year</option>
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
                                    <input class="form-control" value="{{ $employeedata->dob }}" type="date" required name="dob" placeholder="" id="dob">
                                    <small class="form-text text-danger">@error('dob') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="Gender" class="col-form-label">Gender <star>*</star></label>
                                    <select id="BatchTiming" name="gender" required class="form-select" aria-label="Select Gender">
                                        <option value="{{ $employeedata->gender }}" selected>{{ $employeedata->gender }}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                    <small class="form-text text-danger">@error('gender') {{$message}} @enderror</small>
                                </div>
                                {{-- <div class="col-sm-4">
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
                                </div> --}}
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Contact Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="landmark" class="col-form-label">Landmark<star>*</star></label>
                                    <input class="form-control" required type="text" value="{{ $employeedata->landmark }}" name="landmark" placeholder="Landmark" id="landmark" />
                                    <small class="form-text text-danger">@error('landmark') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="country" class="col-form-label">Country <star>*</star></label>
                                    <select class="form-control" required name="country" id="country">
                                        <option value="{{ $employeedata->country }}">{{  $employeedata->country  }}</option>
                                        <option value="India">India</option>
                                    </select>
                                    <small class="form-text text-danger">@error('country') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="listBox" class="col-form-label">State <star>*</star></label>
                                    <input class="form-control" value="{{ $employeedata->state }}" required name="state" />
                                    <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="listBox" class="col-form-label">City <star>*</star></label>
                                    <input class="form-control" value="{{ $employeedata->city }}" required name="city" />
                                    <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                </div>
                                
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" value="{{ $employeedata->pin_code }}" type="tel" name="pin_code" placeholder="Enter Pin code" id="PinCode">
                                    {{-- <small class="form-text text-danger">@error('pin_code') {{$message}} @enderror</small> --}}
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" value="{{ $userdata->mobile }}" required type="tel" name="mobile" placeholder="Enter Mobile No." id="mobileNumber">
                                    <small class="form-text text-danger">@error('mobile') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers (Optional)</label>
                                    <input class="form-control" value="{{ $employeedata->alt_mobile }}" type="tel" name="alt_mobile" placeholder="Enter Alt. Mobile No." id="AltMobile">
                                    {{-- <small class="form-text text-danger">@error('alt_mobile') {{$message}} @enderror</small> --}}
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" value="{{ $userdata->email }}" required type="email" name="email" placeholder="Enter Email" id="email">
                                    {{-- <small class="form-text text-danger">@error('email') {{$message}} @enderror</small> --}}
                                </div>
                                {{-- <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Passport Size Photo <star>*</star></label>
                                    <input class="form-control" type="file" accept="image/*" name="photo" required id="file">
                                    <small class="form-text text-danger">@error('photo') {{$message}} @enderror</small>
                                </div> --}}
                                <div class="col-sm-12 text-center mt-2">
                                    <button name="add_employee" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update Details</button>    
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
