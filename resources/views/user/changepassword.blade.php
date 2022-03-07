@extends('admin.layouts.master')
@section('title', 'Change Password')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">@yield('title')</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Dashboard</a></li>
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
							<h4 class="card-title">@yield('title')</h4>
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
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">New Password</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" name="newpassword" required type="password" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 text-end mb-lg-0 align-self-center">Confirm Password</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input class="form-control" name="cpassword" required type="password" placeholder="Re-Password">
                                        <span class="form-text text-muted font-12">Never share your password.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 offset-lg-3">
                                        <button type="button"  class="btn btn-sm btn-outline-danger">Cancel</button>
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
