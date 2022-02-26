@extends('admin.layouts.master')
@section('title','My Project List')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Project Request</a></li>
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
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Project Id</th>
                                <th>Project Status</th>
                                <th>Project Amount</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                            <tr>
                                <td>Rana</td>
                                <td>132</td>
                                <td>Ongoing</td>
                                <td>Rs 100.00</td>
                                <td>2011/04/25</td>
                                <td>
                                    <a href="{{url('user/upload-image')}}"><button class="btn btn-info btn-sm">Upload&nbsp;Image</button></a>
                                    <a href="{{url('user/upload-video')}}"><button class="btn btn-success btn-sm">Upload&nbsp;Video</button></a>
                                    <button class="btn btn-danger btn-sm">View&nbsp;Details</button>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
