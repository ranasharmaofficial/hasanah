@extends('schooladmin.layouts.master')
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
                            <li class="breadcrumb-item"><a href="{{url('schooladmin/home')}}">Dashboard</a></li>
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
                        <form action="{{route('AddStudetnAdmission')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="card-title font-weight-bold text-uppercase">Official Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="academic-year" class="col-form-label">Select Academic Year <star>*</star></label>
                                        <select class="form-select" required type="text" name="academic_year" id="academicyear">
                                            <option selected disabled>---Select Academic Year----</option>
                                            @foreach ($academicyears as $academicyear)
                                                <option value="{{$academicyear->id}}">{{$academicyear->academicYear}}</option>                                            
                                            @endforeach
                                        </select>
                                       <small class="form-text text-danger">@error('academic_year') {{$message}} @enderror</small>
                                    </div>  
                                    <div class="col-sm-4">
                                        <label for="school_id" class="col-form-label">Select School <star>*</star></label>
                                        <select class="form-select" required type="text" name="school_id" id="school_id">
                                            <option selected disabled>---Select School----</option>
                                            @foreach ($school as $citem)
                                                <option value="{{$citem->id}}">{{$citem->school_name}}</option>                                            
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('school_id') School is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Class" class="col-form-label">Select Class <star>*</star></label>
                                        <select class="form-select" required type="text" name="class_id" id="class_id">
                                            <option selected disabled>---Select Class----</option>
                                            {{-- @foreach ($classes as $citem)
                                                <option value="{{$citem->id}}">{{$citem->class_name}}</option>                                            
                                            @endforeach --}}
                                        </select>
                                        <small class="form-text text-danger">@error('class_id') Class is required. @enderror</small>
                                    </div>
                                    
                                </div>
                            </div>
                            

                            <h4 class="card-title font-weight-bold text-uppercase">Student Personal Details:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="fullname" class="col-form-label">Enter Student's Full Name <star>*</star></label>
                                        <input class="form-control" value="{{old('fullname')}}" type="text" name="fullname" placeholder="Full Name" id="fullname" required>
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
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="nationality" class="col-form-label">Nationality</label>
                                        <select id="nationality" name="nationality" class="form-select" aria-label="Select Nationality">
                                            <option disabled selected value="">Select Nationality</option>
                                            <option value="India">India</option>
                                            <option value="Other">Other</option>
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
                                         
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="religion" class="col-form-label">Religion <star>*</star></label>
                                        <input type="text" name="religion" placeholder="Enter Religion" id="religion" class="form-control" value="{{old('religion')}}">
                                         
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="aadharnumber" class="col-form-label">Aadhar Number <star>*</star></label>
                                        <input class="form-control" required type="number" name="aadharnumber" min="0" placeholder="Enter Aadhar Number" value="{{old('aadharnumber')}}" id="aadharnumber">
                                        <small class="form-text text-danger">@error('aadharnumber') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="mobile" class="col-form-label">Mobile Number <star>*</star></label>
                                        <input class="form-control" type="tel" name="mobile" min="0" placeholder="Enter Mobile Number" value="{{old('mobile')}}" required id="mobilenumber">
                                        <small class="form-text text-danger">@error('mobile') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="email" class="col-form-label">E-mail ID</label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter E-mail ID" value="" id="email">
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="file" class="col-form-label">Upload Photo <star>*</star></label>
                                        <input required class="form-control" type="file" name="studentphoto" id="file">
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
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="city" class="col-form-label">City <star>*</star></label>
                                        <input class="form-control" type="text" required name="city" value="{{old('city')}}" placeholder="Enter city Name" id="city" />
                                        <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="LastName" class="col-form-label">State <star>*</star></label>
                                        <input class="form-control" type="text" name="state"  value="{{old('state')}}" placeholder="Enter state name" id="state" />
                                        <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="col-form-label">Country <star>*</star></label>
                                        <input class="form-control" type="text" name="country" value="{{old('country')}}" placeholder="Enter country name" id="country" />
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
                                            <option value="Uncle">Uncle</option>
                                            <option value="Aunt">Aunt</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="form-text text-danger">@error('relation') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardiandob" class="col-form-label">Date Of Birth</label>
                                        <input class="form-control" type="date" name="guardiandob" value="{{old('guardiandob')}}" id="guardiandob">
                                        
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="education" class="col-form-label">Education</label>
                                        <input class="form-control" type="text" name="education" value="{{old('education')}}" id="education">
                                       
                                    </div> 
                                    <div class="col-sm-4">
                                        <label for="occupation" class="col-form-label">Occupation</label>
                                        <input class="form-control" required type="text" name="occupation" value="{{old('occupation')}}" id="occupation">
                                        <small class="form-text text-danger">@error('occupation') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="income" class="col-form-label">Income</label>
                                        <input class="form-control" type="text" name="income" value="{{old('income')}}" id="income">
                                         
                                    </div>  
                                    <div class="col-sm-4">
                                        <label for="guardianmobile" class="col-form-label">Guardian's Mobile<star>*</star></label>
                                        <input class="form-control" type="number" min="0" name="guardianmobile" required value="{{old('guardianmobile')}}" id="guardianmobile">
                                        <small class="form-text text-danger">@error('guardianmobile') {{$message}} @enderror</small>
                                    </div>  
                                    <div class="col-sm-4">
                                        <label for="guardianaadhar" class="col-form-label">Guardian's Aadhar Number <star>*</star></label>
                                        <input class="form-control" type="number" min="0" name="guardianaadhar" value="{{old('guardianaadhar')}}" id="guardianaadhar">
                                        
                                    </div>                                                            
                                </div>
                            </div> 
                            <h6 class="card-title font-weight-bold text-uppercase">Guardian Contact Details:-</h6><hr>
                            <div class="container">
                                <div class="row mb-3">                                
                                    <div class="col-sm-6">
                                        <label for="guardianaddresslineone" class="col-form-label">Address Line 1 <star>*</star></label>
                                        <input class="form-control" required value="{{old('guardianaddresslineone')}}" type="text" name="guardianaddresslineone" maxlength="150" placeholder="Address Line 1" value="{{old('guardianaddresslineone')}}" id="guardianaddresslineone"/>
                                        <small class="form-text text-danger">@error('guardianaddresslineone') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="guardianaddresslinetwo" class="col-form-label">Address Line 2</label>
                                        <input class="form-control" type="text" value="{{old('guardianaddresslinetwo')}}" name="guardianaddresslinetwo" maxlength="150" placeholder="Address Line 2" value="{{old('guardianaddresslinetwo')}}" id="guardianaddresslinetwo"/>
                                       
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardiancity" class="col-form-label">City <star>*</star></label>
                                        <input class="form-control" type="text" value="{{old('guardiancity')}}" name="guardiancity" placeholder="Enter city Name" id="guardiancity" />
                                        <small class="form-text text-danger">@error('guardiancity') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardianLastName" class="col-form-label">State <star>*</star></label>
                                        <input class="form-control" type="text" value="{{old('guardianstate')}}" name="guardianstate" placeholder="Enter state name" id="guardianstate" />
                                        <small class="form-text text-danger">@error('guardianstate') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardiancountry" class="col-form-label">Country <star>*</star></label>
                                        <input class="form-control" type="text" value="{{old('guardiancountry')}}" name="guardiancountry" placeholder="Enter country name" id="guardiancountry" />
                                        <small class="form-text text-danger">@error('guardiancountry') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="guardianpincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" type="number" min="0" maxlength="10" name="guardianpincode" placeholder="Enter Pincode" value="{{old('guardianpincode')}}" id="guardianpincode">
                                        <small class="form-text text-danger">@error('guardianpincode') {{$message}} @enderror</small>
                                    </div>                                                                
                                </div>
                            </div>

                            {{--<h6 class="card-title font-weight-bold text-uppercase">Fee Details:-</h6><hr>	
                             <div class="container">
                                <div class="row mb-3">                                
                                    <div class="col-sm-6">	
										<label for="guardianpincode" class="col-form-label">Admission Fee <star>*</star></label>									
										<input class="form-control" type="text" required name="admissionfee" value="" id="admissionfee"/> 
									</div>
									<div class="col-sm-6">	
										<label for="guardianpincode" class="col-form-label">Tution Fee <star>*</star></label>									
										<input class="form-control" type="text" name="tutionfee" required value="" id="tutionfee"/>  
									</div>
									<div class="col-sm-6">	
										<label for="guardianpincode" class="col-form-label">Annual Fee <star>*</star></label>									
										<input class="form-control" type="text" name="annualfee" required value="" id="annualfee"/> 
									</div>
									<div class="col-sm-6">	
										<label for="guardianpincode" class="col-form-label">Security Fee <star>*</star></label>									
										<input class="form-control" type="text" name="securitydeposit" required value="" id="securitydeposit"/>            
									</div>
									<div class="col-sm-6">	
										<label for="guardianpincode" class="col-form-label">Miscellanous Fee <star>*</star></label>									
										<input class="form-control" type="text" name="miscellanousfee" required value="" id="miscellanousfee"/>            
									</div>
								</div>
							</div> --}}
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

<script>
    // user country code for selected option
    let user_country_code = "IN";
    
    (function () {
        // script https://www.html-code-generator.com/html/drop-down/country-region
    
        // Get the country name and state name from the imported script.
        let country_list = country_and_states['country'];
        let states_list = country_and_states['states'];
    
        // creating country name drop-down
        let option =  '';
        option += '<option>select country</option>';
        for(let country_code in country_list){
            // set selected option user country
            let selected = (country_code == user_country_code) ? ' selected' : '';
            option += '<option value="'+country_code+'"'+selected+'>'+country_list[country_code]+'</option>';
        }
        document.getElementById('country').innerHTML = option;
    
        // creating states name drop-down
        let text_box = '<input type="text" class="input-text" id="state">';
        let state_code_id = document.getElementById("state-code");
    
        function create_states_dropdown() {
            // get selected country code
            let country_code = document.getElementById("country").value;
            let states = states_list[country_code];
            // invalid country code or no states add textbox
            if(!states){
                state_code_id.innerHTML = text_box;
                return;
            }
            let option = '';
            if (states.length > 0) {
                option = '<select name="state" id="state">\n';
                for (let i = 0; i < states.length; i++) {
                    option += '<option value="'+states[i].code+'">'+states[i].name+'</option>';
                }
                option += '</select>';
            } else {
                // create input textbox if no states 
                option = text_box
            }
            state_code_id.innerHTML = option;
        }
    
        // country select change event
        const country_select = document.getElementById("country");
        country_select.addEventListener('change', create_states_dropdown);
    
        create_states_dropdown();
    })();
    
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script>
        jQuery(document).ready(function(){
        jQuery('#class_id').change(function(){
            let class=jQuery(this).val();
            let datas = "";
            console.log(class)
            jQuery.ajax({
                url:'{{url('getClassAmount')}}',
                type:'post',
                data:'class='+class+'&_token={{csrf_token()}}',
                success:function(result){
                    // jQuery('#project_id').val(''+result+'')
                    if (result == '') {
                        datas += '<option>Not Found.</option>';
                    } else{
                        // console.log(result);
                        $.each(result, function (i) {
                            datas += '<option value="'+result[i].id+'">'+result[i].amount+'</option>';
                            // console.log(datas);
                        });                    
                    }
                    jQuery('#regAmount').html(datas);
                }
            });
        });
    });
    </script> 
    <script>
  
        jQuery(document).ready(function(){

            jQuery('#school_id').change(function(){
            let school=jQuery(this).val();
            let datas = "";
            console.log(school)
    // $('#sub_category').empty();
    // $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
            jQuery.ajax({
                url:'{{url('getClassNames')}}',
                type:'post',
                data:'school='+school+'&_token={{csrf_token()}}',
                success:function(result){
                    // jQuery('#project_id').val(''+result+'')
                    if (result == '') {
                        datas += '<option>Not Found.</option>';
                    } else{
                        // console.log(result);
                        datas +='<option selected disabled>---Select Class---</option>';
                        $.each(result, function (i) {
                            datas += '<option value="'+result[i].id+'">'+result[i].class_name+'</option>';
                            // console.log(datas);
                        });                    
                    }
                    jQuery('#class_id').html(datas);
                }
            });
        });

            jQuery('#class_id').change(function(){
                let cid=jQuery(this).val();
                let datas = "";
                console.log(cid)
                jQuery.ajax({
                    url:'{{url('getClassAmount')}}',
                    type:'post',
                    data:'cid='+cid+'&_token={{csrf_token()}}',
                    success:function(result){
                    jQuery('#regAmount').val(result)
                    }
                });
            });
        });
    </script>
	
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
