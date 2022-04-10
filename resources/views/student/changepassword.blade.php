@extends('student.layouts.master')
@section('title', 'Change Password')
@section('content')

    <div class="page-content">
        <div class="container-fluid">
        <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title align-items-right text-right">
                            <h4 class="text-right"><span class="text-primary"> Student Panel</span></h4>
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
                            <form action="{{route('student.change-password')}}" method="POST" class="row">
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
