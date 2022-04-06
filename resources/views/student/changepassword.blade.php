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
                            <h4 class="text-right">Designation :<span class="text-primary"> Contractor</span></h4>
                            <h4 class="">Last Login at :<span class="text-primary"> {{$lastLoginTime->created_at}}</span></h4>
                            <h4 class="mt-1">Name : <span class="text-primary"> {{ $LoggedContractInfo['name'] }}</span</h4>
                            <h4 class="mt-1">User Id :<span class="text-primary">  {{ $LoggedContractInfo['user_id'] }}</span</h4>
                        </div>
    
    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row justify-content-center">
                <div class="col-8">
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
                                    <div class="col-sm-6">
                                        <label for="oldPassword" class="col-form-label">Current Password <star>*</star></label>
                                        <input type="password" class="form-control" placeholder="Currenet Password" value="" name="oldpassword" id="oldPassword" required>
                                        <small class="form-text text-danger">@error('oldpassword') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="newPassword" class="col-form-label">New Password <star>*</star></label>
                                        <input type="password" class="form-control" placeholder="New Password" value="" name="newpassword" id="newPassword" required>
                                        <small class="form-text text-danger">@error('newpassword') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="cp" class="col-form-label">Confirm Password <star>*</star></label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" value="" name="cpassword" id="cp" required>
                                        <small class="form-text text-danger">@error('cpassword') {{ $message }} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" name="update_pass" class="btn btn-sm btn-outline-primary">Change Password</button>
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
