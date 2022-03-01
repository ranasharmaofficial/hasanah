@extends('admin.layouts.master')
@section('title','Create Company')
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
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Dashboard</a></li>
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
                    <form method="post" action="{{route('admin.create-company')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase">Company Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="established_date" class="col-form-label">Established Date <star>*</star></label>
                                    <input class="form-control" required type="date" name="established_date" placeholder="Established Date" id="established_date">
                                    <small class="form-text text-danger">@error('established_date') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="CompanyName" class="col-form-label">Company Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="company_name" placeholder="Company Name" id="CompanyName">
                                    <small class="form-text text-danger">@error('company_name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="OwnerName" class="col-form-label">Company Owner Name <star>*</star></label>
                                    <input class="form-control" required type="text" name="owner_name" placeholder="Owner Name" id="OwnerName">
                                    <small class="form-text text-danger">@error('owner_name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="panNo" class="col-form-label">Pan Number</label>
                                    <input class="form-control" type="tel" name="panno" placeholder="Enter Pan Number" id="panNo">
                                    <small class="form-text text-danger">@error('panno') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="gstNo" class="col-form-label">GST Number</label>
                                    <input class="form-control" type="text" name="gst" placeholder="Enter GST Number" id="gstNo">
                                    <small class="form-text text-danger">@error('gst') {{$message}} @enderror</small>
                                </div>

                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Company Address Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="landmark" class="col-form-label">Landmark <star>*</star></label>
                                    <input class="form-control" required name="landmark" placeholder="Enter landmark" id="landmark" />
                                    <small class="form-text text-danger">@error('landmark') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="country" class="col-form-label">Country <star>*</star></label>
                                    <select class="form-select" required name="country" id="country">
                                        <option value="India">India</option>
                                    </select>
                                    <small class="form-text text-danger">@error('country') {{$message}} @enderror</small>
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
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" required type="tel" name="pin_code" placeholder="" id="PinCode">
                                    <small class="form-text text-danger">@error('pin_code') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" required type="tel" name="mobile_no" placeholder="Enter Mobile No." id="mobileNumber">
                                    <small class="form-text text-danger">@error('mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers</label>
                                    <input class="form-control" type="tel" name="alt_mobile_no" placeholder="Enter Alt. Mobile No." id="AltMobile">
                                    <small class="form-text text-danger">@error('alt_mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" required type="email" name="email" placeholder="Enter Email" id="email">
                                    <small class="form-text text-danger">@error('email') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Logo <star>*</star></label>
                                    <input class="form-control" type="file" name="company_logo" required id="file">
                                    <small class="form-text text-danger">@error('company_logo') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="add_company" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit Now</button>
                                </div>
                            </div>
                        </div>
                     </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
