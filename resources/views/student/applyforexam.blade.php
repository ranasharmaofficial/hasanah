@extends('student.layouts.master')
@section('title', 'Apply for Entrance Exam')
@section('content')
<style>
#state{
    display: block;
    width: 100%;
    padding: 0.47rem 0.75rem;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.5;
    color: #505d69;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
</style>
    <div class="page-content">
        <div class="container-fluid">            
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title text-white">@yield('title')</h3>
                        </div>
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

                            @if (!$getformappliedornot)
                            <form action="{{route('student.entranceExam')}}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <h5 class="text-primary">Personal Details</h5><hr>
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
                                    <div class="col-sm-4">
                                        <label for="name" class="col-form-label">Name <star>*</star></label>
                                        <input type="text" class="form-control" placeholder="Name" value="" name="name" id="name" required>
                                        <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Mobile" class="col-form-label">Mobile <star>*</star></label>
                                        <input type="tel" class="form-control" placeholder="Mobile" value="" name="mobile" id="Mobile" required>
                                        <small class="form-text text-danger">@error('mobile') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Email" class="col-form-label">Email <star>*</star></label>
                                        <input type="email" class="form-control" placeholder="Email" value="" name="email" id="Email" required>
                                        <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="col-form-label">Select Country <star>*</star></label>
                                        <select name="country" class="form-select" required id="country">
                                            <option>select country</option>
                                        </select>
                                        <small class="form-text text-danger">@error('country') {{ $message }} @enderror</small>
                                    </div>
                                        
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="state">Select State <star>*</star></label>
                                        <span class="" id="state-code"><input name="state" required type="text" id="state"></span>
                                        <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="secondlist" class="col-form-label">City <star>*</star></label>
                                        <input type="text" class="form-control" placeholder="Enter City" required name="city" id='secondlist'/>
                                        <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="pincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" required type="tel" name="pincode" value="{{old('pincode')}}" placeholder="Enter Pin code" id="pincode">
                                        <small class="form-text text-danger">@error('pincode') {{$message}} @enderror</small>
                                    </div>
                                    <h5 class="text-primary mt-3">Upload Documents</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="PassportPhoto" class="col-form-label">Passport Photo. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Passport Photo" value="" name="passport_photo" id="PassportPhoto">
                                        <small class="form-text text-danger">@error('passport_photo') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Aadhar" class="col-form-label">Aadhar Card. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Aadhar Card" value="" name="aadhar_card" id="Aadhar">
                                        <small class="form-text text-danger">@error('aadhar_card') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Father" class="col-form-label">Father's Aadhar Card. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Father Card" value="" name="father_aadhar_card" id="Aadhar">
                                        <small class="form-text text-danger">@error('father_aadhar_card') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Marksheet" class="col-form-label">Last Year Exam Marksheet <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Last Year Exam Marksheet" value="" name="last_year_marksheet" id="Marksheet">
                                        <small class="form-text text-danger">@error('last_year_marksheet') {{ $message }} @enderror</small>
                                    </div>
                                    <h5 class="text-primary mt-3">Payment Details</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="regAmount" class="col-form-label">Registration Fee <star>*</star></label>
                                        <input type="text" class="form-control" required placeholder="Registration Amount" value="" readonly name="registration_fee" id="regAmount">
                                        <small class="form-text text-danger">@error('registration_fee') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-4 text-center">
                                        <button type="submit" name="apply" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Process Now</button>
                                    </div>                                   
                                </div>
                                   
                            </form>
                            @else
                                <h4 class="text-success text-center">You have already applied.</h4>
                                <p class="text-center">
                                    Form Status: @if ($getformappliedornot->status == '1')
                                    <span class="text-warning">Pending</span>
                                @elseif ($getformappliedornot->status == '2')
                                <span class="text-success" onclick="window.location.href='{{url('student/admit-card')}}'">Accepted download your admit card.</span>
                                @else
                                <span class="text-danger">Rejected</span>
                                @endif
                            </p>                           
                            @endif
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
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
    {{-- <script>
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
    </script> --}}
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
@endsection
