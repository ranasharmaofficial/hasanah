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
                    <div class="col-sm-12">
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
                    </div>
                    <form method="post" action="{{route('uploadProjectCategory')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Project Category Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="Company" class="col-form-label">Select Company <star>*</star></label>
                                    <select class="form-select" required type="text" name="company_id" id="Company">
                                        <option selected disabled value="">---Select Company----</option>
                                        @foreach ($companydata as $citem)
                                            <option value="{{$citem->company_id}}">{{$citem->company_name}}</option>                                            
                                        @endforeach
                                    </select>
                                    <small class="form-text text-danger">@error('company_id') Project category name is required. @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ProjectName" class="col-form-label">Project Category Name <star>*</star></label>
                                    <input class="form-control" required type="text" name="project_cat_name" placeholder="Project Category Name" value="{{old('project_cat_name')}}" id="ProjectName">
                                    <small class="form-text text-danger">@error('project_cat_name') Project category name is required. @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ProjectAmount" class="col-form-label">Set Project Amount <star>*</star></label>
                                    <input class="form-control" required type="number" name="project_amount" value="{{old('project_amount')}}" placeholder="Enter Project Amount" id="ProjectAmount">
                                    <small class="form-text text-danger">@error('project_amount') Project amount is required. @enderror</small>
                                </div>  
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="add_project_category" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit Now</button>
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
