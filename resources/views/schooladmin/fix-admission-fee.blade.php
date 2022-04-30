@extends('schooladmin.layouts.master')
@section('title','Fix Admission Fee')
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
        
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card rounded">
                    <div class="card-header bg-dark">
                        <h3 class="card-title text-success">@yield('title')</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row mb-3">
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
                                <form action="{{route('uploadAdmissionFee')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12">
                                        <label for="CourseName" class="col-form-label">Select Course <star>*</star></label>
                                        <select name="coursename" id="coursename" class="form-select">
                                            @foreach ($courses as $course)
                                            <option value="{{$course->course_id}}">{{$course->courseName}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger form-text">@error('coursename') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="admissionfee" class="col-form-label">Admission Fee <star>*</star></label>
                                        <input class="form-control" type="tel" name="admissionfee" required id="admissionfee" placeholder="Enter Admission Fee" value="{{old('admissionfee')}}">
                                        <small class="text-danger form-text">@error('admissionfee') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tutionfee" class="col-form-label">Tution Fee <star>*</star></label>
                                        <input class="form-control" type="tel" name="tutionfee" required id="tutionfee" placeholder="Enter Tution Fee" value="{{old('tutionfee')}}">
                                        <small class="text-danger form-text">@error('tutionfee') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="annualfee" class="col-form-label">Annual Fee <star>*</star></label>
                                        <input class="form-control" type="tel" name="annualfee" required id="annualfee" placeholder="Enter Annual Fee" value="{{old('annualfee')}}">
                                        <small class="text-danger form-text">@error('annualfee') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="miscellanousfee" class="col-form-label">Miscellanous Fee <star>*</star></label>
                                        <input class="form-control" type="tel" name="miscellanousfee" required id="miscellanousfee" placeholder="Enter Miscellanous Fee" value="{{old('miscellanousfee')}}">
                                        <small class="text-danger form-text">@error('miscellanousfee') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="securitydeposit" class="col-form-label">Security Deposit <star>*</star></label>
                                        <input class="form-control" type="tel" name="securitydeposit" required id="securitydeposit" placeholder="Enter Security Deposit" value="{{old('securitydeposit')}}">
                                        <small class="text-danger form-text">@error('securitydeposit') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_course" type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Submit</button>
                                    </div>
                                </form>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
