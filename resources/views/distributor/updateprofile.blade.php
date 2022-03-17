@extends('user.layouts.master')
@section('title', 'Update Profile')
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
                                <div class="col-sm-6">
                                    <label for="Project" class="col-form-label">Name <star>*</star></label>
                                    <input type="text" class="form-control" value="{{$userData->name}}" name="name" id="Project" required>
                                    <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Mobile" class="col-form-label">Mobile <star>*</star></label>
                                    <input type="text" class="form-control" name="mobile" id="Mobile" required>
                                    <small class="form-text text-danger">@error('mobile') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Email" class="col-form-label">Email <star>*</star></label>
                                    <input type="text" class="form-control" name="email" id="Email" required>
                                    <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Address" class="col-form-label">Address <star>*</star></label>
                                    <input type="text" value="{{$userData->name}}" class="form-control" name="address" id="Address" required>
                                    <small class="form-text text-danger">@error('address') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Aadhar" class="col-form-label">Aadhar Number<star>*</star></label>
                                    <input type="text" value="{{$userData->name}}" class="form-control" name="aadhar" id="Aadhar" required>
                                    <small class="form-text text-danger">@error('aadhar') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="submit" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Update</button>
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
