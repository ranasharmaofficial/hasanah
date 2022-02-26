@extends('admin.layouts.master')
@section('title','Create Project Category')
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
                        <h4 class="card-title font-weight-bold text-uppercase">Project Category Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="ProjectName" class="col-form-label">Project Category Name <star>*</star></label>
                                    <input class="form-control" required type="text" name="project_cat_name" placeholder="Project Category Name" id="ProjectName">
                                </div>
                                <div class="col-sm-6">
                                    <label for="ProjectAmount" class="col-form-label">Set Project Amount <star>*</star></label>
                                    <input class="form-control" required type="number" name="project_amount" placeholder="Project Amount" id="ProjectAmount">
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
