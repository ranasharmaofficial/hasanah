@extends('distributor.layouts.master')
@section('title','Applied Project List')
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
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white">@yield('title')</h4>
                        <p class="p-0 m-0 text-white">Total Applied Project: <b>{{$appliedproject->total();}}</b>, Page No: <b>{{$appliedproject->currentPage();}}</b></p>
                        
                    </div>
                    <div class="card-body">

                        <h4 class="card-title">@yield('title')</h4>
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Project</th>
                                <th>Project Amount</th>
                                 <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                @foreach ($appliedproject as $key => $data)
                                <tr>
                                    <td>{{($appliedproject->currentpage()-1) * $appliedproject->perpage() + $key + 1}}</td>
                                    <td>{{$data->project_name}}</td>
                                    <td>Rs&nbsp;{{$data->amount}}</td>
                                     
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm">View Details</button>
                                        <button class="btn btn-danger btn-sm">Block</button>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                {{$appliedproject->links();}}
                                            </ul>
                                        </nav>
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
