@extends('admin.layouts.master')
@section('title','Add Student')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
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
                        <h4 class="card-title font-weight-bold text-uppercase">Official Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="academic-year" class="col-form-label">Select Academic Year <star>*</star></label>
                                    <select id="academic-year" name="academic_year" class="form-select" aria-label="Default select example">
                                        <option selected="">Select Academic Year</option>
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2024-2025">2024-2025</option>
                                        <option value="2026-2027">2026-2027</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="example" class="col-form-label">Admission number <star>*</star></label>
                                    <input class="form-control" type="number" name="admission_number" placeholder="Admission Number" id="example">
                                </div>
                                <div class="col-sm-4">
                                    <label for="JoiningDate" class="col-form-label">Joining Date <star>*</star></label>
                                    <input class="form-control" type="date" name="joining_date" placeholder="Joining Date" id="JoiningDate">
                                </div>
                                <div class="col-sm-4">
                                    <label for="Selectcourse" class="col-form-label">Select Course <star>*</star></label>
                                    <select id="Selectcourse" name="course" class="form-select" aria-label="Selectcourse">
                                        <option selected="">Select Course</option>
                                        <option value="Engineering">Engineering</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="BatchTiming" class="col-form-label">Select Batch Timing <star>*</star></label>
                                    <select id="BatchTiming" name="batch_timing" class="form-select" aria-label="Select Batch Timing">
                                        <option selected="">Select Batch Timing</option>
                                        <option value="Batch Timing">Batch Timing</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="rollNumber" class="col-form-label">Roll Number <star>*</star></label>
                                    <input class="form-control" type="tel" name="roll_number" placeholder="Roll Number" id="rollNumber">
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Personal Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="FirstName" class="col-form-label">First Name <star>*</star></label>
                                    <input class="form-control" type="number" name="first_name" placeholder="First Name" id="FirstName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="MiddleName" class="col-form-label">Middle Name</label>
                                    <input class="form-control" type="date" name="middle_name" placeholder="Middle Name" id="MiddleName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="LastName" class="col-form-label">Last Name <star>*</star></label>
                                    <input class="form-control" type="tel" name="last_name" placeholder="Last Name" id="LastName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="dob" class="col-form-label">Date of Birth <star>*</star></label>
                                    <input class="form-control" type="date" name="dob" placeholder="" id="dob">
                                </div>
                                <div class="col-sm-4">
                                    <label for="Gender" class="col-form-label">Gender <star>*</star></label>
                                    <select id="BatchTiming" name="batch_timing" class="form-select" aria-label="Select Gender">
                                        <option disabled selected="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="Gender" class="col-form-label">Blood Group <star>*</star></label>
                                    <select id="BatchTiming" name="batch_timing" class="form-select" aria-label="Select Gender">
                                        <option disabled selected="">Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="birthPlace" class="col-form-label">Birth Place <star>*</star></label>
                                    <input class="form-control" type="text" name="birth_place" placeholder="" id="birthPlace">
                                </div>
                                <div class="col-sm-4">
                                    <label for="aadharNumber" class="col-form-label">Aadhar Number <star>*</star></label>
                                    <input class="form-control" type="text" name="aadhar_number" placeholder="" id="aadharNumber">
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Contact Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="FirstName" class="col-form-label">Permanent Address <star>*</star></label>
                                    <textarea class="form-control" name="permanent_address" placeholder="Permanent Address" id="FirstName"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="MiddleName" class="col-form-label">Persent Address</label>
                                    <textarea class="form-control" name="persent_address" placeholder="Persent Address" id="FirstName"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="LastName" class="col-form-label">State <star>*</star></label>
                                    <select class="form-control" type="tel" name="state" placeholder="Last Name" id="state">
                                        <option value="">State</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="LastName" class="col-form-label">City <star>*</star></label>
                                    <select class="form-control" type="tel" name="city" placeholder="Last Name" id="City">
                                        <option value="">City</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" type="text" name="pin_code" placeholder="" id="PinCode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" type="tel" name="mobile_no" placeholder="" id="PinCode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers <star>*</star></label>
                                    <input class="form-control" type="tel" name="alt_mobile_no" placeholder="" id="AltMobile">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" type="email" name="email" placeholder="" id="email">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Photo <star>*</star></label>
                                    <input class="form-control" type="file" name="file"  id="file">
                                </div>
                                
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Father Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="FirstName" class="col-form-label">Name <star>*</star></label>
                                    <input class="form-control" name="father_name" placeholder="Permanent Address" id="FatherName">
                                </div>
                                <div class="col-sm-6">
                                    <label for="MiddleName" class="col-form-label">Mobile</label>
                                    <input class="form-control" name="father_mobile" placeholder="Persent Address" id="FatherMobile">
                                </div>
                                <div class="col-sm-6">
                                    <label for="FatherJob" class="col-form-label">Job</label>
                                    <input class="form-control" name="father_job" placeholder="" id="FatherJob">
                                </div>
                                <div class="col-sm-6">
                                    <label for="FatherAadhar" class="col-form-label">Father Aadhar</label>
                                    <input class="form-control" name="father_aadhar" placeholder="" id="FatherAadhar">
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Mother Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="MotherName" class="col-form-label">Name <star>*</star></label>
                                    <input class="form-control" name="mother_name" placeholder="Permanent Address" id="MotherName">
                                </div>
                                <div class="col-sm-6">
                                    <label for="MotherMobile" class="col-form-label">Mobile</label>
                                    <input class="form-control" name="mother_mobile" placeholder="Persent Address" id="MotherMobile">
                                </div>
                                <div class="col-sm-6">
                                    <label for="MotherJob" class="col-form-label">Job</label>
                                    <input class="form-control" name="mother_job" placeholder="" id="MotherJob">
                                </div>
                                <div class="col-sm-6">
                                    <label for="MotherAadhar" class="col-form-label">Mother Aadhar</label>
                                    <input class="form-control" name="mother_aadhar" placeholder="" id="MotherAadhar">
                                </div>
                            </div>
                        </div>
                    
                        <button name="add_student" type="submit" class="btn btn-info">Save</button>
                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
