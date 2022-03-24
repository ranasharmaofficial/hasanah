@extends('distributor.layouts.master')
@section('title','Project Request List')
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
                        <p class="p-0 m-0 text-white">Total Project Request: <b>{{$projectrequest->total();}}</b>, Page No: <b>{{$projectrequest->currentPage();}}</b></p>
                        
                    </div>
                    <div class="card-body">

                        <h4 class="card-title">@yield('title')</h4>
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Beneficiary Name</th>
                                <th>Beneficiary Mobile</th>
                                <th>Alt Mobile</th>
                                <th>Full Address</th>
                                <th>Picture</th>
                                <th>Video</th>
                                 <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                @foreach ($projectrequest as $key => $data)
                                <tr>
                                    <td>{{($projectrequest->currentpage()-1) * $projectrequest->perpage() + $key + 1}}</td>
                                    <td>{{$data->beneficiray_name}}</td>
                                    <td>{{$data->beneficiary_mobile}}</td>
                                    <td>{{$data->alt_mobile_number}}</td>
                                    <td>{{$data->full_address}}</td>
                                    <td><img style="max-width:120px;" src="{{asset('uploads/proposal/'.$data->proposal_photo)}}" alt="" class="img-thumbanil"></td>
                                    <td><video width='220px' height='220px' src="{{asset('uploads/proposal/'.$data->proposal_video)}}" controls></video></td>
                                     
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
                                                {{$projectrequest->links();}}
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
