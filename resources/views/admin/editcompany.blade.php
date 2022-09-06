@extends('admin.layouts.master')
@section('title','Edit Company')
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
                    <form method="post" action="{{route('admin.editCompanyDetails')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase">Company Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="established_date" class="col-form-label">Established Date <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->established_date }}" required type="date" name="established_date" placeholder="Established Date" id="established_date">
                                    <small class="form-text text-danger">@error('established_date') {{$message}} @enderror</small>
                                </div>
                                <input type="hidden" name="company_id" value="{{ $company_daata->company_id }}">
                                <div class="col-sm-4">
                                    <label for="CompanyName" class="col-form-label">Registration No <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->registration_number }}" type="text" required name="registration_number" id="registration_number">
                                    <small class="form-text text-danger">@error('registration_number') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="CompanyName" class="col-form-label">Company Name <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->company_name }}" type="text" required name="company_name" placeholder="Company Name" id="CompanyName">
                                    <small class="form-text text-danger">@error('company_name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="OwnerName" class="col-form-label">Company Owner Name <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->owner_name }}"  required type="text" name="owner_name" placeholder="Owner Name" id="OwnerName">
                                    <small class="form-text text-danger">@error('owner_name') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="panNo" class="col-form-label">Pan Number</label>
                                    <input class="form-control" value="{{ $company_daata->pan_number }}"  type="tel" name="panno" placeholder="Enter Pan Number" id="panNo">
                                    <small class="form-text text-danger">@error('panno') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="gstNo" class="col-form-label">GST Number</label>
                                    <input class="form-control" value="{{ $company_daata->gst_number }}"  type="text" name="gst" placeholder="Enter GST Number" id="gstNo">
                                    <small class="form-text text-danger">@error('gst') {{$message}} @enderror</small>
                                </div>

                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Company Address Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="landmark" class="col-form-label">Landmark <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->land_mark }}"  required name="landmark" placeholder="Enter landmark" id="landmark" />
                                    <small class="form-text text-danger">@error('landmark') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="country" class="col-form-label">Country <star>*</star></label>
                                   <input class="form-control" value="{{ $company_daata->country }}" required name="country" id="listBox"/>
                                    <small class="form-text text-danger">@error('country') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="listBox" class="col-form-label">State <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->state }}" required name="state" id="listBox"/>
                                    <small class="form-text text-danger">@error('state') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="secondlist" class="col-form-label">City <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->city }}"  required name="city" id='secondlist'/>
                                    <small class="form-text text-danger">@error('city') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->pin_code }}"  required type="tel" name="pin_code" placeholder="" id="PinCode">
                                    <small class="form-text text-danger">@error('pin_code') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->mobile }}"  required type="tel" name="mobile_no" id="mobileNumber">
                                    <small class="form-text text-danger">@error('mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers</label>
                                    <input class="form-control" value="{{ $company_daata->alt_mobile }}"  type="tel" name="alt_mobile_no" id="AltMobile">
                                    <small class="form-text text-danger">@error('alt_mobile_no') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->email }}"  required type="email" name="email" placeholder="Enter Email" id="email">
                                    <small class="form-text text-danger">@error('email') {{$message}} @enderror</small>
                                </div>
                                {{-- <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Logo <star>*</star></label>
                                    <input class="form-control" value="{{ $company_daata->logo }}"  type="file" name="company_logo" id="file">
                                    <small class="form-text text-danger">@error('company_logo') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Current Logo <star>*</star></label>
                                    <img style="height:100px;" class="img-thumbnail" src="{{asset('uploads/company-logo/'.$company_daata->logo)}}" alt="">
                                </div> --}}
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="add_company" type="submit" class="btn btn-danger"><i class="fa fa-paper-plane"></i> Update Details</button>
                                </div>
                            </div>
                        </div>
                     </form>
                     {{-- company profile image update --}}
                     <form method="post" action="{{route('admin.editCompanyLogo')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-danger text-uppercase">Update Company Logo:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <input class="form-control" required value="{{ $company_daata->company_id }}" type="hidden" name="comapny_idss">
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Logo <star>*</star></label>
                                    <input class="form-control" required type="file" name="company_logo" id="file">
                                    
                                    <small class="form-text text-danger">@error('company_logo') {{$message}} @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Current Logo <star>*</star></label>
                                    <img style="height:100px;" class="img-thumbnail" src="{{asset('uploads/company-logo/'.$company_daata->logo)}}" alt="">
                                </div>
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="add_company" type="submit" class="btn btn-danger"><i class="fa fa-paper-plane"></i> Update Logo</button>
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
