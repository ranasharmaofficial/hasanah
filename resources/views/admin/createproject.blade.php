@extends('admin.layouts.master')
@section('title','Create Project')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
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
                        <h4 class="card-title font-weight-bold text-uppercase">Project Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="Company" class="col-form-label">Select Company <star>*</star></label>
                                    <select class="form-control" required type="text" name="company_id" id="Company">
                                        <option value="1">Company A</option>
                                        <option value="1">Company B</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="Project" class="col-form-label">Select Project Category<star>*</star></label>
                                    <select class="form-control" required type="text" name="project_id" id="Project">
                                        <option value="1">Project A</option>
                                        <option value="1">Project B</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ProjectName" class="col-form-label">Project Name <star>*</star></label>
                                    <input class="form-control" required type="text" name="project_name" placeholder="Project Name" id="ProjectName">
                                </div>
                                <div class="col-sm-4">
                                    <label for="ProjectNumber" class="col-form-label">Project Number <star>*</star></label>
                                    <input class="form-control" required type="text" name="project_number" placeholder="Project Number" id="ProjectNumber">
                                </div>
                                <div class="col-sm-4">
                                    <label for="ProjectTitle" class="col-form-label">Project Title <star>*</star></label>
                                    <input class="form-control" required type="text" name="project_title" placeholder="Project Title" id="ProjectTitle">
                                </div>
                                <div class="col-sm-4">
                                    <label for="Project Amount" class="col-form-label">Project Amount <star>*</star></label>
                                    <input class="form-control" required type="text" name="project_amount" placeholder="Project Amount" id="ProjectAmount">
                                </div>
                                <div class="col-sm-4">
                                    <label for="distributorID" class="col-form-label">Select Distributor <star>*</star></label>
                                    <select class="form-control" required name="distributor_id" id="distributorID">
                                        <option value="1">Rana</option>
                                        <option value="1">A</option>
                                        <option value="1">C</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <button name="add_teacher" type="submit" class="btn btn-info">Save</button>
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
