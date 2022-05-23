@extends('employee.layouts.master')
@section('title', 'Change Password')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 img_com">
                                <img src="{{asset('uploads/company-logo/'.$companydata->logo)}}" alt="" class="img-thumbnail imagefix">
                            </div>
                            <div class="col-sm-8">
                                <h4 class="dist_companyname text-primary">{{$companydata->company_name}}</h4>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title align-items-right text-right">
                            <h4 class="text-right">Designation :<span class="text-primary"> Employee</span></h4>
                            <h4 class="">Last Login at :<span class="text-primary"> {{$lastLoginTime->created_at}}</span></h4>
                            <h4 class="mt-1">Name : <span class="text-primary"> {{ $employeedata['name'] }}</span</h4>
                            <h4 class="mt-1">User Id :<span class="text-primary">  {{ $employeedata['user_id'] }}</span</h4>
                        </div>
    
    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h5 class="card-title text-white">@yield('title')</h5>
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
                            <form action="{{route('employee.change-password')}}" method="POST" class="row">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="oldPassword" class="col-form-label">Current Password <star>*</star></label>
                                        <input type="password" class="form-control" placeholder="Current Password" value="{{old('old_password')}}" name="old_password" id="oldPassword" required>
                                        <small class="form-text text-danger">@error('old_password') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="newPassword" class="col-form-label">New Password <star>*</star></label>
                                        <input type="password" class="form-control" placeholder="New Password" value="{{old('new_password')}}" name="new_password" id="newPassword" required>
                                        <small class="form-text text-danger">@error('new_password') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="cp" class="col-form-label">Confirm Password <star>*</star></label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" value="{{old('confirm_password')}}" name="confirm_password" id="cp" required>
                                        <small class="form-text text-danger">@error('cpassword') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-4 text-center">
                                        <button type="submit" name="update_pass" class="btn btn-outline-success">Change Password</button>
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
@endsection
