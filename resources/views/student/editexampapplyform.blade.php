@php
use \App\Http\Controllers\StudentController;
@endphp
@extends('student.layouts.master')
@section('title', 'Edit Details of Student')
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
                            <form action="{{route('student.entranceExam')}}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <h5 class="text-primary">Personal Details</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="Class" class="col-form-label">Select Class <star>*</star></label>
                                        <select class="form-select" required type="text" name="class_id" id="class_id">
                                            <option selected value="{{$studendetails->class_id}}">{{StudentController::getClassName($studendetails->class_id)}}</option>
                                            @foreach ($classes as $citem)
                                                <option value="{{$citem->id}}">{{$citem->class_name}}</option>                                            
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('class_id') Class is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="name" class="col-form-label">Name <star>*</star></label>
                                        <input type="text" class="form-control" placeholder="Name" value="{{$studendetails->name}}" name="name" id="name" required>
                                        <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Mobile" class="col-form-label">Mobile <star>*</star></label>
                                        <input type="tel" class="form-control" placeholder="Mobile" value="{{$studendetails->mobile}}" name="mobile" id="Mobile" required>
                                        <small class="form-text text-danger">@error('mobile') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Email" class="col-form-label">Email <star>*</star></label>
                                        <input type="email" class="form-control" placeholder="Email" value="{{$studendetails->email}}" name="email" id="Email" required>
                                        <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="col-form-label">Select Country <star>*</star></label>
                                        <select name="country" id="country" class="form-select" required>
                                            <option selected value="{{$studendetails->country}}">{{$studendetails->country}}</option>
                                        </select>
                                        <small class="form-text text-danger">@error('country') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="listBox" class="col-form-label">State <star>*</star></label>
                                        <select class="form-select" required name="state" id="listBox" onchange='selct_district(this.value)'>
                                            <option selected value="{{$studendetails->state}}">{{$studendetails->state}}</option>
                                        </select>
                                        <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="secondlist" class="col-form-label">City <star>*</star></label>
                                        <select class="form-select" required name="city" id='secondlist'></select>
                                        <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="pincode" class="col-form-label">Pin Code <star>*</star></label>
                                        <input class="form-control" required type="tel" name="pincode" value="{{$studendetails->pincode}}" placeholder="Enter Pin code" id="pincode">
                                        <small class="form-text text-danger">@error('pincode') {{$message}} @enderror</small>
                                    </div>
                                    <h5 class="text-primary mt-3">Upload Documents</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="PassportPhoto" class="col-form-label">Passport Photo. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Passport Photo" value="{{$studendetails->passport_photo}}" name="passport_photo" id="PassportPhoto">
                                        <a onclick="showPassportPhoto(this)" id="{{$studendetails->id}}" class="btn btn-primary btn-sm mt-2">Preview Passport Photo</a>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Aadhar" class="col-form-label">Aadhar Card. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Aadhar Card" value="{{$studendetails->aadhar_card}}" name="aadhar_card" id="Aadhar" required>
                                        <button type="button" onclick="showAadharCard(this)" id="{{$studendetails->id}}" class="btn btn-primary btn-sm mt-2">Preview Aadhar card</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Father" class="col-form-label">Father's Aadhar Card. <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Father Card" value="{{$studendetails->father_aadhar_card}}" name="father_aadhar_card" id="Aadhar" required>
                                        <button type="button" onclick="showFatherAadharCard(this)" id="{{$studendetails->id}}" class="btn btn-primary btn-sm mt-2">Preview</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="Marksheet" class="col-form-label">Last Year Exam Marksheet <star>*</star></label>
                                        <input type="file" class="form-control" placeholder="Last Year Exam Marksheet" value="{{$studendetails->last_year_exam_marksheet}}" name="last_year_marksheet" id="Marksheet" required>
                                        <button type="button" onclick="showMarkSheet(this)" id="{{$studendetails->id}}" class="btn btn-primary btn-sm mt-2">Preview</button>
                                    </div>
                                    <h5 class="text-primary mt-3">Payment Details</h5><hr>
                                    <div class="col-sm-4">
                                        <label for="regAmount" class="col-form-label">Registration Fee <star>*</star></label>
                                        <input type="text" class="form-control" placeholder="Registration Amount" value="{{$studendetails->registration_fee}}" readonly name="registration_fee" id="regAmount" required>
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
    
    <!--  Passport Photo Image Start -->
<div class="modal fade bs-example-modal-lg" id="passportphoto" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">{{$studendetails->name}}'s Passport Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="passportphotodetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Passport Photo Image Start-->

<!--  Aadhar Card Photo Image Start -->
<div class="modal fade bs-example-modal-lg" id="aadharCard" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">{{$studendetails->name}}'s Aadhar Card Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="aadharcarddetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Aadhar card Image Start-->

<!--  Father Aadhar card Image Start -->
<div class="modal fade bs-example-modal-lg" id="fatheraadharCard" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">{{$studendetails->name}}'s Father's Aadhar Card Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="fatheraadharcarddetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Father aadhar card Image Start-->

<!--  Mark sheet card Image Start -->
<div class="modal fade bs-example-modal-lg" id="marksheet" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">{{$studendetails->name}}'s Father's Aadhar Card Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="marksheetdetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Mark sheet card Image Start-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        function showPassportPhoto(showPassportPhoto){
        $('#passportphoto').modal('show'); 
		let datas = '';
        let studentid = $(showPassportPhoto).attr('id');
        $('#studentid').html(studentid);
        $.ajax({
            url: '{{url('getPassportPhoto')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#passportphotodetails').html(datas);
			}
        })
    }

    function showAadharCard(showAadharCard){
        $('#aadharCard').modal('show'); 
		let datas = '';
        let studentid = $(showAadharCard).attr('id');
        $('#studentid').html(studentid);
        $.ajax({
            url: '{{url('getAadharCard')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#aadharcarddetails').html(datas);
			}
        })
    }
    
    function showFatherAadharCard(showFatherAadharCard){
        $('#fatheraadharCard').modal('show'); 
		let datas = '';
        let studentid = $(showFatherAadharCard).attr('id');
        $('#studentid').html(studentid);
        $.ajax({
            url: '{{url('getFatherAadharCard')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#fatheraadharcarddetails').html(datas);
			}
        })
    }

    function showMarkSheet(showMarkSheet){
        $('#marksheet').modal('show'); 
		let datas = '';
        let studentid = $(showMarkSheet).attr('id');
        $('#studentid').html(studentid);
        $.ajax({
            url: '{{url('getMarkSheet')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#marksheetdetails').html(datas);
			}
        })
    }
    </script>
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
