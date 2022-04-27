@extends('student.layouts.master')
@section('title', 'Apply Admission Form')
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
                            <li class="breadcrumb-item"><a href="{{url('student/home')}}">Dashboard</a></li>
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
                        <form action="{{route('studentAdmissionApply')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="card-title font-weight-bold text-uppercase">Official Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="academic-year" class="col-form-label">Select Academic Year <star>*</star></label>
                                        <select id="academic-year" name="academic_year" required class="form-select" aria-label="Default select example">
                                            <option selected="" disabled>Select Academic Year</option>
                                            @foreach ($academicyears as $academicyear)
                                                <option value="{{$academicyear->id}}">{{$academicyear->academicYear}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('academic_year') {{$message}} @enderror</small>
                                    </div>
                                    {{-- <div class="col-sm-4">
                                        <label for="JoiningDate" class="col-form-label">Joining Date <star>*</star></label>
                                        <input class="form-control" type="date" name="joining_date" placeholder="Joining Date" required value="{{old('joining_date')}}" id="JoiningDate">
                                        <small class="form-text text-danger">@error('joining_date') {{$message}} @enderror</small>
                                    </div> --}}
                                    <div class="col-sm-4">
                                        <label for="selectcourse" class="col-form-label">Select Course <star>*</star></label>
                                        <select id="selectcourse" name="selectcourse" class="form-select" required aria-label="selectcourse">
                                            <option selected="" disabled>Select Course</option>
                                            @foreach ($courses as $course)
                                            <option value="{{$course->course_id}}">{{$course->courseName}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('selectcourse') {{$message}} @enderror</small>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $LoggedStudentInfo['student_id'] }}" name="studentid" required />

                            <h4 class="card-title font-weight-bold text-uppercase">Student Personal Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="fullname" class="col-form-label">Enter Student's Full Name <star>*</star></label>
                                        <input class="form-control" type="text" name="fullname" placeholder="Full Name" value="{{old('fullname')}}" id="fullname" required>
                                        <small class="form-text text-danger">@error('fullname') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="dob" class="col-form-label">Date of Birth <star>*</star></label>
                                        <input class="form-control" type="date" name="dob" value="{{old('dob')}}" required id="dob">
                                        <small class="form-text text-danger">@error('dob') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="gender" class="col-form-label">Gender <star>*</star></label>
                                        <select id="gender" name="gender" class="form-select" aria-label="Select Gender">
                                            <option disabled selected value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="bloodgroup" class="col-form-label">Blood Group <star>*</star></label>
                                        <select id="bloodgroup" name="bloodgroup" class="form-select" aria-label="Select Blood Group">
                                            <option disabled selected value="">Select Blood Group</option>
                                            <option value="Unknown">Unknown</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="A1+">A1+</option>
                                            <option value="A1-">A1-</option>
                                            <option value="A1B+">A1B+</option>
                                            <option value="A1B-">A1B-</option>
                                            <option value="A2-">A2-</option>
                                            <option value="A2+">A2+</option>
                                            <option value="A2B+">A2B+</option>
                                            <option value="A2B-">A2B-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="B1+">B1+</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                        <small class="form-text text-danger">@error('bloodgroup') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="birthplace" class="col-form-label">Birth Place</label>
                                        <input class="form-control" type="text" name="birthplace" placeholder="Enter Birth Place" value="{{old('birthplace')}}" id="birthplace">
                                        <small class="form-text text-danger">@error('birthplace') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="nationality" class="col-form-label">Nationality</label>
                                        <select id="nationality" name="nationality" class="form-select" aria-label="Select Nationality">
                                            <option disabled selected value="">Select Nationality</option>
                                            <option value="India">India</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="category" class="col-form-label">Student Category <star>*</star></label>
                                        <select id="category" name="category" class="form-select" aria-label="Select Student's Category">
                                            <option disabled selected value="">Select Student's Category</option>
                                            <option value="OBC">OBC</option>
                                            <option value="EBC">EBC</option>
                                            <option value="GENERAL">GENERAL</option>
                                            <option value="SC/ST">SC/ST</option>
                                        </select>
                                        <small class="form-text text-danger">@error('category') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="religion" class="col-form-label">Religion <star>*</star></label>
                                        <input type="text" name="religion" placeholder="Enter Religion" id="religion" class="form-control" value="{{old('religion')}}">
                                        <small class="form-text text-danger">@error('religion') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="aadharnumber" class="col-form-label">Aadhar Number <star>*</star></label>
                                        <input class="form-control" type="number" name="aadharnumber" min="0" placeholder="Enter Aadhar Number" value="{{old('aadharnumber')}}" id="aadharnumber">
                                        <small class="form-text text-danger">@error('aadharnumber') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="mobilenumber" class="col-form-label">Mobile Number <star>*</star></label>
                                        <input class="form-control" type="tel" name="mobilenumber" min="0" placeholder="Enter Mobile Number" value="{{old('mobilenumber')}}" required id="mobilenumber">
                                        <small class="form-text text-danger">@error('mobilenumber') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="emailid" class="col-form-label">E-mail ID</label>
                                        <input class="form-control" type="email" name="emailid" placeholder="Enter E-mail ID" value="{{old('emailid')}}" id="emailid">
                                        <small class="form-text text-danger">@error('emailid') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="file" class="col-form-label">Upload Photo <star>*</star></label>
                                        <input class="form-control" type="file" name="studentphoto" id="file">
                                        <small class="form-text text-danger">@error('studentphoto') {{$message}} @enderror</small>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title font-weight-bold text-uppercase">Student Communication Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="addresslineone" class="col-form-label">Address Line 1 <star>*</star></label>
                                        <input class="form-control" required name="addresslineone" maxlength="150" placeholder="Address Line 1" value="{{old('addresslineone')}}" id="addresslineone"/>
                                        <small class="form-text text-danger">@error('addresslineone') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="addresslinetwo" class="col-form-label">Address Line 2</label>
                                        <input class="form-control" name="addresslinetwo" maxlength="150" placeholder="Address Line 2" value="{{old('addresslinetwo')}}" id="addresslinetwo"/>
                                        <small class="form-text text-danger">@error('addresslinetwo') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="city" class="col-form-label">City <star>*</star></label>
                                        <input class="form-control" type="text" required name="city" placeholder="Enter city Name" id="city" />
                                        <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="LastName" class="col-form-label">State <star>*</star></label>
                                        <input class="form-control" type="text" name="state" placeholder="Enter state name" id="state" />
                                        <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="col-form-label">Country <star>*</star></label>
                                        <input class="form-control" type="text" name="country" placeholder="Enter country name" id="country" />
                                        <small class="form-text text-danger">@error('country') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="pincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" type="number" min="0" maxlength="10" name="pincode" placeholder="Enter Pincode" value="{{old('pincode')}}" id="pincode">
                                        <small class="form-text text-danger">@error('pincode') {{$message}} @enderror</small>
                                    </div>                               
                                </div>
                            </div>
                            <h6 class="card-title font-weight-bold text-uppercase">Guardian Personal Details:-</h6><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="guardianname" class="col-form-label">Guardian's Full Name <star>*</star></label>
                                        <input class="form-control" type="text" maxlength="150" name="guardianname" placeholder="Enter guardian's Full Name" value="{{old('guardianname')}}" id="guardianname">
                                        <small class="form-text text-danger">@error('guardianname') {{$message}} @enderror</small>
                                    </div>   
                                    <div class="col-sm-4">
                                        <label for="relation" class="col-form-label">Relation <star>*</star></label>
                                        <select name="relation" id="relation" class="form-select">
                                            <option value="" selected disabled>Select Relation</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="form-text text-danger">@error('relation') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardiandob" class="col-form-label">Date Of Birth</label>
                                        <input class="form-control" type="date" name="guardiandob" value="{{old('guardiandob')}}" id="guardiandob">
                                        <small class="form-text text-danger">@error('guardiandob') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="education" class="col-form-label">Education</label>
                                        <input class="form-control" type="text" name="education" value="{{old('education')}}" id="education">
                                        <small class="form-text text-danger">@error('education') {{$message}} @enderror</small>
                                    </div> 
                                    <div class="col-sm-4">
                                        <label for="occupation" class="col-form-label">Occupation</label>
                                        <input class="form-control" type="text" name="occupation" value="{{old('occupation')}}" id="occupation">
                                        <small class="form-text text-danger">@error('occupation') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="income" class="col-form-label">Income</label>
                                        <input class="form-control" type="text" name="income" value="{{old('income')}}" id="income">
                                        <small class="form-text text-danger">@error('income') {{$message}} @enderror</small>
                                    </div>  
                                    <div class="col-sm-4">
                                        <label for="guardianmobile" class="col-form-label">Guardian's Mobile<star>*</star></label>
                                        <input class="form-control" type="number" min="0" name="guardianmobile" required value="{{old('guardianmobile')}}" id="guardianmobile">
                                        <small class="form-text text-danger">@error('guardianmobile') {{$message}} @enderror</small>
                                    </div>  
                                    <div class="col-sm-4">
                                        <label for="guardianaadhar" class="col-form-label">Guardian's Aadhar Number <star>*</star></label>
                                        <input class="form-control" type="number" min="0" name="guardianaadhar" value="{{old('guardianaadhar')}}" id="guardianaadhar">
                                        <small class="form-text text-danger">@error('guardianaadhar') {{$message}} @enderror</small>
                                    </div>                                                            
                                </div>
                            </div> 
                            <h6 class="card-title font-weight-bold text-uppercase">Guardian Contact Details:-</h6><hr>
                            <div class="container">
                                <div class="row mb-3">                                
                                    <div class="col-sm-6">
                                        <label for="guardianaddresslineone" class="col-form-label">Address Line 1 <star>*</star></label>
                                        <input class="form-control" type="text" name="guardianaddresslineone" maxlength="150" placeholder="Address Line 1" value="{{old('guardianaddresslineone')}}" id="guardianaddresslineone"/>
                                        <small class="form-text text-danger">@error('guardianaddresslineone') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="guardianaddresslinetwo" class="col-form-label">Address Line 2</label>
                                        <input class="form-control" type="text" name="guardianaddresslinetwo" maxlength="150" placeholder="Address Line 2" value="{{old('guardianaddresslinetwo')}}" id="guardianaddresslinetwo"/>
                                        <small class="form-text text-danger">@error('guardianaddresslinetwo') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardiancity" class="col-form-label">City <star>*</star></label>
                                        <input class="form-control" type="text" name="guardiancity" placeholder="Enter city Name" id="guardiancity" />
                                        <small class="form-text text-danger">@error('guardiancity') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardianLastName" class="col-form-label">State <star>*</star></label>
                                        <input class="form-control" type="text" name="guardianstate" placeholder="Enter state name" id="guardianstate" />
                                        <small class="form-text text-danger">@error('guardianstate') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardiancountry" class="col-form-label">Country <star>*</star></label>
                                        <input class="form-control" type="text" name="guardiancountry" placeholder="Enter country name" id="guardiancountry" />
                                        <small class="form-text text-danger">@error('guardiancountry') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardianpincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" type="number" min="0" maxlength="10" name="guardianpincode" placeholder="Enter Pincode" value="{{old('guardianpincode')}}" id="guardianpincode">
                                        <small class="form-text text-danger">@error('guardianpincode') {{$message}} @enderror</small>
                                    </div>                                                                
                                </div>
                            </div> 
                            <h6 class="card-title font-weight-bold text-uppercase">Payment Details:-</h6><hr>
                            <div class="container">
                                <div class="row mb-3">                                
                                    <div class="col-sm-6">
                                        <label for="admissionfee" class="col-form-label">Admission Fee <star>*</star></label>
                                        <input class="form-control" type="text" required name="admissionfee" placeholder="Admission fee here..." value="{{old('admissionfee')}}" readonly id="admissionfee"/>
                                        <small class="form-text text-danger">@error('admissionfee') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tutionfee" class="col-form-label">Tution Fee <star>*</star></label>
                                        <input class="form-control" type="text" name="tutionfee" readonly placeholder="Tution fee here..." required value="{{old('tutionfee')}}" id="tutionfee"/>
                                        <small class="form-text text-danger">@error('tutionfee') {{$message}} @enderror</small>
                                    </div>                                                                
                                </div>
                            </div>                   
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button name="add_student" type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Proceed</button>
                                </div>
                            </div>  
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function(){
        jQuery('#selectcourse').change(function(){
            let courseid=jQuery(this).val();
            
    $('#batchtime').empty();
    $('#batchtime').append(`<option value="" disabled selected>Processing...</option>`);
            jQuery.ajax({
                url:'{{url('getBatchTime')}}',
                type:'post',
                async: true,
                cache: false,
                data:'courseid=' + courseid + '&_token={{csrf_token()}}',
                success:function(response){
                    jQuery('#batchtime').html(response)
                }
            });

            jQuery.ajax({
                url:'{{url('getAdmissionFee')}}',
                type:'post',
                async: true,
                cache: false,
                data:'courseid=' + courseid + '&_token={{csrf_token()}}',
                success:function(response_fee){
                    var feedata = JSON.parse(response_fee)
                    // console.log(feedata.admission_fee)
                    jQuery('#admissionfee').val('Rs:'+' '+feedata.admission_fee+'/-')
                    jQuery('#tutionfee').val('Rs:'+' '+feedata.tution_fee+'/-')
                }
            });


        });
    });
</script>
@endsection
