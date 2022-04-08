@extends('student.layouts.master')
@section('title', 'Apply for Entrance Exam')
@section('content')

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
                            <form action="{{route('student.entranceExam')}}" method="POST" class="row">
                                @csrf
                                <div class="row">
                                    <h5 class="text-primary">Personal Details</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="Class" class="col-form-label">Select Class <star>*</star></label>
                                        <select class="form-select" required type="text" name="class_id" id="class_id">
                                            <option selected disabled>---Select Class----</option>
                                            @foreach ($classes as $citem)
                                                <option value="{{$citem->id}}">{{$citem->class_name}}</option>                                            
                                            @endforeach
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
                                        <select name="country" id="country" class="form-select" required>
                                            <option value="India">India</option>
                                        </select>
                                        <small class="form-text text-danger">@error('country') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="listBox" class="col-form-label">State <star>*</star></label>
                                        <select class="form-select" required name="state" id="listBox" onchange='selct_district(this.value)'></select>
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
                                    <h5 class="text-primary mt-3">Upload Documents</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="Aadhar" class="col-form-label">Aadhar Card. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Aadhar Card" value="" name="aadhar_card" id="Aadhar" required>
                                        <small class="form-text text-danger">@error('aadhar_card') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Father" class="col-form-label">Father's Aadhar Card. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Father Card" value="" name="father_aadhar_card" id="Aadhar" required>
                                        <small class="form-text text-danger">@error('father_aadhar_card') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Marksheet" class="col-form-label">Last Year Exam Marksheet <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Last Year Exam Marksheet" value="" name="last_year_marksheet" id="Marksheet" required>
                                        <small class="form-text text-danger">@error('last_year_marksheet') {{ $message }} @enderror</small>
                                    </div>
                                    <h5 class="text-primary mt-3">Payment Details</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="regAmount" class="col-form-label">Registration Fee <star>*</star></label>
                                        <input type="text" class="form-control" placeholder="Registration Amount" value="" readonly name="registration_fee" id="regAmount" required>
                                        <small class="form-text text-danger">@error('registration_fee') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-4 text-center">
                                        <button type="submit" name="apply" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Process Now</button>
                                    </div>                                   
                                </div>
                                   
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
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
