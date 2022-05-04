@extends('schoolemployee.layouts.master')
@section('title','Add Teacher')
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
                            <li class="breadcrumb-item"><a href="{{asset('schooladmin/home')}}">Dashboard</a></li>
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
                        <form action="{{route('schoolemployee.uploadTeacherData')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="card-title font-weight-bold text-uppercase">Official Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="teachercategory" class="col-form-label">Teacher Category <star>*</star></label>
                                        <select class="form-select" name="teachercategory" id="teachercategory">
                                            <option value="">-- Select Teacher Category --</option>
                                            @foreach ($teachercategory as $item)                                                
                                                <option value="{{$item->id}}">{{$item->category}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('teachercategory') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="example" class="col-form-label">Joining Date <star>*</star></label>
                                        <input class="form-control" type="date" name="joining_date" placeholder="Joining Date" id="example">
                                        <small class="form-text text-danger">@error('joining_date') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="qualification" class="col-form-label">Qualification <star>*</star></label>
                                        <input class="form-control" type="text" name="qualification" placeholder="Qualification" id="qualification">
                                        <small class="form-text text-danger">@error('qualification') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Experience" class="col-form-label">Total Experience (in Year) <star>*</star></label>
                                        <input class="form-control" type="tel" name="experience" placeholder="Experience" id="Experience">
                                        <small class="form-text text-danger">@error('experience') {{$message}} @enderror</small>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title font-weight-bold text-uppercase">Personal Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="fullname" class="col-form-label">Full Name <star>*</star></label>
                                        <input class="form-control" type="text" required value="{{old('fullname')}}" name="fullname" placeholder="Full Name" id="fullname">
                                        <small class="form-text text-danger">@error('fullname') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="dob" class="col-form-label">Date of Birth <star>*</star></label>
                                        <input class="form-control" type="date" name="dob" required id="dob">
                                        <small class="form-text text-danger">@error('dob') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="gender" class="col-form-label">Gender <star>*</star></label>
                                        <select id="gender" name="gender" class="form-select" required aria-label="Select Gender">
                                            <option disabled selected="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <small class="form-text text-danger">@error('gender') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="aadharnumber" class="col-form-label">Aadhar Number <star>*</star></label>
                                        <input class="form-control" type="text" name="aadharnumber" value="{{old('aadharnumber')}}" required placeholder="Enter Aadhar Number" id="aadharnumber">
                                        <small class="form-text text-danger">@error('aadharnumber') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="panno" class="col-form-label">Pan Number <star>*</star></label>
                                        <input class="form-control" type="tel" name="panno" placeholder="Enter Pan Number" required value="{{old('panno')}}" id="panno">
                                        <small class="form-text text-danger">@error('panno') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="mobileno" class="col-form-label">Mobile Number <star>*</star></label>
                                        <input class="form-control" type="tel" name="mobileno" required placeholder="Enter Mobile Number" id="mobileno">
                                        <small class="form-text text-danger">@error('mobileno') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="altmobile" class="col-form-label">Alt Mobile Numbers</label>
                                        <input class="form-control" type="tel" name="altmobile" placeholder="Enter Alternative Mobile Number" id="altmobile">
                                        <small class="form-text text-danger">@error('altmobile') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                        <input class="form-control" type="email" name="email" required placeholder="Enter Email ID" id="email">
                                        <small class="form-text text-danger">@error('email') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="passportimage" class="col-form-label">Upload Photo <star>*</star></label>
                                        <input class="form-control" type="file" name="passportimage" required id="passportimage">
                                        <small class="form-text text-danger">@error('passportimage') {{$message}} @enderror</small>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title font-weight-bold text-uppercase">Contact Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <h4 class="card-title font-weight-bold text-uppercase text-primary">Permanent Address:-</h4>
                                    <div class="col-sm-6">
                                        <label for="addressone" class="col-form-label">Address Line 1 <star>*</star></label>
                                        <textarea class="form-control" name="addressone" required placeholder="Address Line 1" id="addressone">{{old('addressone')}}</textarea>
                                        <small class="form-text text-danger">@error('addressone') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="addresstwo" class="col-form-label">Address Line 2</label>
                                        <textarea class="form-control" name="addresstwo" placeholder="Address Line 2" id="addresstwo">{{old('addresstwo')}}</textarea>
                                        <small class="form-text text-danger">@error('addresstwo') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="city" class="col-form-label">City <star>*</star></label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" required/>
                                        <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="state" class="col-form-label">State <star>*</star></label>
                                        <input type="text" class="form-control" name="state" required placeholder="Enter State" id="state"/>
                                        <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="col-form-label">Country <star>*</star></label>
                                        <input type="text" class="form-control" name="country" required placeholder="Enter Country Name" id="country"/>
                                        <small class="form-text text-danger">@error('country') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="pincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" type="tel" name="pincode" required placeholder="Enter Pin Code" value="{{old('pincode')}}" id="pincode">
                                        <small class="form-text text-danger">@error('pincode') {{$message}} @enderror</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="filltoo" id="filltoo" onclick="filladd()">
                                        <label class="form-check-label" for="filltoo">
                                            Permanent Address same as Current Address
                                        </label>
                                    </div>
                                    <h4 class="card-title font-weight-bold text-uppercase text-primary">Current Address:-</h4>
                                    <div class="col-sm-6">
                                        <label for="currentaddressone" class="col-form-label">Address Line 1 <star>*</star></label>
                                        <textarea class="form-control" name="currentaddressone" required placeholder="Current Address Line 1" id="currentaddressone">{{old('currentaddressone')}}</textarea>
                                        <small class="form-text text-danger">@error('currentaddressone') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="currentaddresstwo" class="col-form-label">Address Line 2</label>
                                        <textarea class="form-control" name="currentaddresstwo" placeholder="Current Address Line 2" id="currentaddresstwo">{{old('currentaddresstwo')}}</textarea>
                                        <small class="form-text text-danger">@error('currentaddresstwo') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="currentcity" class="col-form-label">City <star>*</star></label>
                                        <input type="text" class="form-control" name="currentcity" id="currentcity" placeholder="Enter Current City" required/>
                                        <small class="form-text text-danger">@error('currentcity') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="currentstate" class="col-form-label">State <star>*</star></label>
                                        <input type="text" class="form-control" name="currentstate" required placeholder="Enter Current State" id="currentstate"/>
                                        <small class="form-text text-danger">@error('currentstate') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="currentcountry" class="col-form-label">Country <star>*</star></label>
                                        <input type="text" class="form-control" name="currentcountry" required placeholder="Enter Current Country Name" id="currentcountry"/>
                                        <small class="form-text text-danger">@error('currentcountry') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="currentpincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" type="tel" name="currentpincode" required placeholder="Enter Pin Code" value="{{old('pincode')}}" id="currentpincode">
                                        <small class="form-text text-danger">@error('currentpincode') {{$message}} @enderror</small>
                                    </div>

                                    <div class="col-sm-12 text-center mt-3">
                                        <button name="add_teacher" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Upload Teacher Data</button>
                                    </div>
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

<script type="text/javascript">
function filladd(){
	 if(filltoo.checked == true) {
        var addressone =document.getElementById("addressone").value;
        var addresstwo =document.getElementById("addresstwo").value;
        var city =document.getElementById("city").value;
        var state =document.getElementById("state").value;
        var country =document.getElementById("country").value;
        var pincode =document.getElementById("pincode").value;
        
        document.getElementById("currentaddressone").value = addressone;
        document.getElementById("currentaddresstwo").value = addresstwo;
        document.getElementById("currentcity").value = city;
        document.getElementById("currentstate").value = state;
        document.getElementById("currentcountry").value = country;
        document.getElementById("currentpincode").value = pincode;

        document.getElementById("currentaddressone").readOnly = true;
        document.getElementById("currentaddresstwo").readOnly = true;
        document.getElementById("currentcity").readOnly = true;
        document.getElementById("currentstate").readOnly = true;
        document.getElementById("currentcountry").readOnly = true;
        document.getElementById("currentpincode").readOnly = true;
	 }
	 else if(filltoo.checked == false) {
        document.getElementById("currentaddressone").value = '';
        document.getElementById("currentaddresstwo").value = '';
        document.getElementById("currentcity").value = '';
        document.getElementById("currentstate").value = '';
        document.getElementById("currentcountry").value = '';
        document.getElementById("currentpincode").value = '';

        document.getElementById("currentaddressone").readOnly = false;
        document.getElementById("currentaddresstwo").readOnly = false;
        document.getElementById("currentcity").readOnly = false;
        document.getElementById("currentstate").readOnly = false;
        document.getElementById("currentcountry").readOnly = false;
        document.getElementById("currentpincode").readOnly = false;
	 }
}
</script>
@endsection
