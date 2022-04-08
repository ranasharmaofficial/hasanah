@extends('student.layouts.master')
@section('title', 'Apply for Entrance Exam')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @yield('title')
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
                            <form action="" method="POST" class="row">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="Class" class="col-form-label">Select Class <star>*</star></label>
                                        <select class="form-select" required type="text" name="class_id" id="class_id">
                                            <option selected disabled>---Select Class----</option>
                                            @foreach ($classes as $citem)
                                                <option value="{{$citem->id}}">{{$citem->class_name}}</option>                                            
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('company_id') Project category name is required. @enderror</small>
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
                                    <div class="col-sm-4">
                                        <label for="regAmount" class="col-form-label">Registration Amount <star>*</star></label>
                                        <input type="text" class="form-control" placeholder="Registration Amount" value="" name="last_year_marksheet" id="regAmount" required>
                                        <small class="form-text text-danger">@error('last_year_marksheet') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="address" class="col-form-label">Full Address <star>*</star></label>
                                        <textarea type="text" class="form-control" placeholder="Enter Your Full Address" value="" name="full_address" id="address" required></textarea>
                                        <small class="form-text text-danger">@error('full_address') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" name="apply" class="btn btn-sm btn-primary">Apply</button>
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
