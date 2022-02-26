@extends('admin.layouts.master')
@section('title','Update Company')
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
                        <h4 class="card-title font-weight-bold text-uppercase">Company Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="companycode" class="col-form-label">Company Code <star>*</star></label>
                                    <input class="form-control" type="number" name="company_code" placeholder="Employee Code" id="companycode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="example" class="col-form-label">Created Date <star>*</star></label>
                                    <input class="form-control" type="date" name="created_date" placeholder="Created Date" id="example">
                                </div>
                                <div class="col-sm-4">
                                    <label for="CompanyName" class="col-form-label">Company Name <star>*</star></label>
                                    <input class="form-control" type="text" name="company_name" placeholder="Company Name" id="CompanyName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="CompanyTitle" class="col-form-label">Company Title <star>*</star></label>
                                    <input class="form-control" type="text" name="company_title" placeholder="Company Title" id="CompanyTitle">
                                </div>
                                <div class="col-sm-4">
                                    <label for="Experience" class="col-form-label">Total Experience <star>*</star></label>
                                    <input class="form-control" type="text" name="experience" placeholder="Experience" id="Experience">
                                </div>
                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Personal Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="OwnerName" class="col-form-label">Company Owner Name <star>*</star></label>
                                    <input class="form-control" type="text" name="owner_name" placeholder="Owner Name" id="OwnerName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="panNo" class="col-form-label">Pan Number <star>*</star></label>
                                    <input class="form-control" type="tel" name="panno" placeholder="" id="panNo">
                                </div>
                                <div class="col-sm-4">
                                    <label for="gstNo" class="col-form-label">GST Number <star>*</star></label>
                                    <input class="form-control" type="tel" name="gst" placeholder="" id="gstNo">
                                </div>

                            </div>
                        </div>

                        <h4 class="card-title font-weight-bold text-uppercase">Company Address Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="FirstName" class="col-form-label">Permanent Address <star>*</star></label>
                                    <textarea class="form-control" name="permanent_address" placeholder="Permanent Address" id="FirstName"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="MiddleName" class="col-form-label">Persent Address</label>
                                    <textarea class="form-control" name="persent_address" placeholder="Persent Address" id="FirstName"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="LastName" class="col-form-label">State <star>*</star></label>
                                    <select class="form-control" type="tel" name="state" placeholder="Last Name" id="state">
                                        <option value="">State</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="LastName" class="col-form-label">City <star>*</star></label>
                                    <select class="form-control" type="tel" name="city" placeholder="Last Name" id="City">
                                        <option value="">City</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input class="form-control" type="text" name="pin_code" placeholder="" id="PinCode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="PinCode" class="col-form-label">Mobile Number <star>*</star></label>
                                    <input class="form-control" type="tel" name="mobile_no" placeholder="" id="PinCode">
                                </div>
                                <div class="col-sm-4">
                                    <label for="AltMobile" class="col-form-label">Alt Mobile Numbers <star>*</star></label>
                                    <input class="form-control" type="tel" name="alt_mobile_no" placeholder="" id="AltMobile">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Email Id <star>*</star></label>
                                    <input class="form-control" type="email" name="email" placeholder="" id="email">
                                </div>
                                <div class="col-sm-4">
                                    <label for="email" class="col-form-label">Upload Photo <star>*</star></label>
                                    <input class="form-control" type="file" name="file"  id="file">
                                </div>
                                
                            </div>
                        </div>
                         <button name="add_teacher" type="submit" class="btn btn-info">Save</button>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
