@extends('distributor.layouts.master')
@section('title','Ongoing Project List')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ongoing Project</a></li>
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
                        <p class="p-0 m-0 text-white">Total Ongoing Project: <b>{{$ongoingProjects->total();}}</b>, Page No: <b>{{$ongoingProjects->currentPage();}}</b></p>
                        
                    </div>
                    <div class="card-body">
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
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-dark">
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Contractor&nbsp;ID</th>
                                    <th>Contractor&nbsp;Name</th>
                                    {{-- <th>Company</th> --}}
                                    <th>Category</th>
                                    <th>Project&nbsp;Name</th>
                                    <th>Project&nbsp;Number</th>
                                    <th>Project&nbsp;Status</th>
                                    <th>Project&nbsp;Amount</th>
                                    <th>Days&nbsp;to&nbsp;Left</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($ongoingProjects as $key => $data)
                                @php
                                    $ldate = date('Y-m-d');
                                    $datedays = strtotime($data->no_of_days)-strtotime($ldate);
                                    $datediff = (round($datedays / 86400));
                                @endphp
                                <tr>
                                    <td>{{($ongoingProjects->currentpage()-1) * $ongoingProjects->perpage() + $key + 1}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{ucfirst($data->contractor_name)}}</td>
                                    {{-- <td>{{$data->company_name}}</td> --}}
                                    <td>{{$data->project_category}}</td>
                                    <td>{{$data->project_name}}</td>
                                    <td>{{$data->project_number}}</td>
                                    <td>Ongoing</td>
                                    <td class="text-primary">Rs:&nbsp;{{$data->project_amount}}/-</td>
                                    <td class="text-danger">
                                        <p class="bg-success text-white p-1 rounded shadow"><strong>Date&nbsp;From:</strong>&nbsp;{{$data->created_at->format('d-m-Y')}}</p>
                                        <p class="bg-danger text-white p-1 rounded shadow"><strong>Days to left:</strong>&nbsp;{{$datediff}}</p>
                                    </td>
                                    <td> 
                                        <form action="{{route('distributor.view-project-details')}}" method="get" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$data->project_id}}" name="project_id" required>
                                            <input type="hidden" value="{{$data->username}}" name="user_id" required>
                                            <button type="submit" class="btn btn-danger btn-sm">View&nbsp;Details</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">Project Not Available</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="7">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                {{$ongoingProjects->links();}}
                                            </ul>
                                        </nav>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
