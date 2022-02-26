@extends('admin.layouts.master')
@section('title','View Work Details')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="" class="row" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="Project">Project Id <star>*</star></label>
                                    <input class="form-control" id="Project" required type="text"
                                         name="project_id" />
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Proceed</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Project Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Project Name :</th>
                                    <td>project name</td>
                                </tr>
                                <tr>
                                    <th>Project Title : </th>
                                    <td>project_title </td>
                                </tr>
                                <tr>
                                    <th>Project Created Date : </th>
                                    <td>12/01/2000 </td>
                                </tr>
                                <tr>
                                    <th>Project Amount : </th>
                                    <td>1234 </td>
                                </tr>
                                <tr>
                                    <th>Distributor : </th>
                                    <td>1234 </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary">Apply for This Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col sm-6 -->
              
            
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection