@extends('admin.layouts.master')
@section('title','Add Distributor')
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
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="" enctype="multipart/form-data" class="card-body">
                        <h4 class="card-title font-weight-bold text-uppercase">Personal Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="FirstName" class="col-form-label">First Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="first_name" placeholder="First Name" id="FirstName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="MiddleName" class="col-form-label">Middle Name</label>
                                    <input class="form-control" type="text" required name="middle_name" placeholder="Middle Name" id="MiddleName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="LastName" class="col-form-label">Last Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="last_name" placeholder="Last Name" id="LastName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="dob" class="col-form-label">Date of Birth <star>*</star></label>
                                    <input class="form-control" type="date" required name="dob" placeholder="" id="dob">
                                </div>
                                <div class="col-sm-4">
                                    <label for="Gender" class="col-form-label">Gender <star>*</star></label>
                                    <select id="BatchTiming" name="gender" required class="form-select" aria-label="Select Gender">
                                        <option disabled selected="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="aadharNumber" class="col-form-label">Aadhar Card (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="aadhar_number" placeholder="" id="aadharNumber">
                                </div>
                                <div class="col-sm-4">
                                    <label for="panNo" class="col-form-label">Pan Card (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="panno" placeholder="" id="panNo">
                                </div>
                                <div class="col-sm-4">
                                    <label for="Voter" class="col-form-label">Voter Id (Pdf Format) <star>*</star></label>
                                    <input required class="form-control" accept="application/pdf" type="file" name="panno" placeholder="" id="Voter">
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Contact Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="permAddress" class="col-form-label">Permanent Address <star>*</star></label>
                                    <textarea class="form-control" required  name="permanent_address" placeholder="Permanent Address" id="permAddress"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="persAddress" class="col-form-label">Persent Address</label>
                                    <textarea class="form-control" name="persent_address" placeholder="Persent Address" id="persAddress"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="listBox" class="col-form-label">State <star>*</star></label>
                                    <select class="form-control" required name="state" id="listBox" onchange='selct_district(this.value)'></select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" required type="tel" name="pin_code" placeholder="Enter Pin code" id="PinCode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" required type="tel" name="mobile_no" placeholder="Enter Mobile No." id="mobileNumber">
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers <star>*</star></label>
                                    <input class="form-control" required type="tel" name="alt_mobile_no" placeholder="Enter Alt. Mobile No." id="AltMobile">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" required type="email" name="email" placeholder="Enter Email" id="email">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Photo <star>*</star></label>
                                    <input class="form-control" type="file" name="file"  id="file">
                                </div>
                                
                            </div>
                        </div>
                         <button name="add_teacher" type="submit" class="btn btn-info">Save</button>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
