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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Company</a></li>
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
                    <form method="post" action="" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase">Company Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="example" class="col-form-label">Created Date <star>*</star></label>
                                    <input class="form-control" required type="date" name="created_date" placeholder="Created Date" id="example">
                                </div>
                                <div class="col-sm-4">
                                    <label for="CompanyName" class="col-form-label">Company Name <star>*</star></label>
                                    <input class="form-control" type="text" required name="company_name" placeholder="Company Name" id="CompanyName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="CompanyTitle" class="col-form-label">Company Title <star>*</star></label>
                                    <input class="form-control" type="text" required name="company_title" placeholder="Company Title" id="CompanyTitle">
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Personal Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="OwnerName" class="col-form-label">Company Owner Name <star>*</star></label>
                                    <input class="form-control" required type="text" name="owner_name" placeholder="Owner Name" id="OwnerName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="panNo" class="col-form-label">Pan Number</label>
                                    <input class="form-control" type="tel" name="panno" placeholder="" id="panNo">
                                </div>
                                <div class="col-sm-4">
                                    <label for="gstNo" class="col-form-label">GST Number</label>
                                    <input class="form-control" type="text" name="gst" placeholder="" id="gstNo">
                                </div>

                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Company Address Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="FirstName" class="col-form-label">Permanent Address <star>*</star></label>
                                    <textarea class="form-control" required name="permanent_address" placeholder="Permanent Address" id="FirstName"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="MiddleName" class="col-form-label">Persent Address</label>
                                    <textarea class="form-control" required name="persent_address" placeholder="Persent Address" id="FirstName"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="listBox" class="col-form-label">State <star>*</star></label>
                                    <select class="form-control" required name="state" id="listBox" onchange='selct_district(this.value)'></select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="secondlist" class="col-form-label">City <star>*</star></label>
                                    <select class="form-control" required name="city" id='secondlist'></select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" required type="tel" name="pin_code" placeholder="" id="PinCode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="mobileNumber" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" required type="tel" name="mobile_no" placeholder="Enter Mobile No." id="mobileNumber">
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers <star>*</star></label>
                                    <input class="form-control" required type="tel" name="alt_mobile_no" placeholder="Enter Alt. Mobile No." id="AltMobile">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" required type="email" name="email" placeholder="Enter Email" id="email">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Photo <star>*</star></label>
                                    <input class="form-control" type="file" name="file"  id="file">
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <button name="add_company" type="submit" class="btn btn-info">Save</button>
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
