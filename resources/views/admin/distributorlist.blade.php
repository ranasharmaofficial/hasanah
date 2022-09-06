@extends('admin.layouts.master')
@section('title','Distributor List')
@section('content')
<style>
    .dtr-title{
        font-weight: bold;
        color: blue;
        font-size: 20px;
    }
    .dtr-data
    {
        font-weight: 900 !important;
        color: #ff0052;
        font-size: 18px;
        margin-left: 14px;
    }
</style>
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
                    <div class="card-body">
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
                        <h4 class="card-title">@yield('title')</h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
                                    <th>Company Name</th>
                                    <th>User ID</th>
                                    <th>Password</th>
                                    <th>Mobile</th>
                                    <th>Date of Joining</th>
                                    <th>Total Project</th>
                                    <th>Completed Project</th>
                                    <th>Ongoing Project</th>
                                    <th>Pending Project</th>
                                    <th>Emergency Project</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
    
    
                                <tbody>
                                    @php
                                    $s=1;
                                @endphp 
                                    @foreach ($distributor as $item)
                                    @php
                                         $total_project_count = App\Models\Project::where('distributor_id',$item->distributor_reg)->count();
                                         $completed_project_count = App\Models\Project::where('distributor_id',$item->distributor_reg)->where('action',3)->where('project_status',3)->count();
                                         $ongoing_project_count = App\Models\Project::where('distributor_id',$item->distributor_reg)->where('action',2)->where('project_status',2)->count();
                                    @endphp
                                    <tr>
                                        <td>{{$s++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{ $item->company_ka_name }}</td>
                                        <td>{{$item->user_id}}</td>
                                        <td>{{$item->password}}</td>
                                        <td>{{$item->mobile}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{ $total_project_count }}</td>
                                        <td>{{ $completed_project_count }}</td>
                                        <td>{{ $ongoing_project_count }}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupVerticalDrop1" type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                    <a class="dropdown-item" href="{{ url('admin/view-distributor/'.$item->distributor_reg) }}">View Details</a>
                                                    <a class="dropdown-item" href="{{ url('admin/edit-distributor/'.$item->distributor_reg) }}">Edit Details</a>
                                                    {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                                                </div>
                                            </div>
                                        </td>
                                     </tr>
                                    @endforeach
                            {{-- <tr>
                                
                                @foreach ($distributor as $item)
                                <tr>
                                    <td>{{$item->user_id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->password}}</td>
                                    <td>{{$item->qualification}}</td>
                                    <td>{{$item->dob}}</td>
                                    <td>
                                        <form action="{{url('admin/removeDistributor')}}" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" value="{{$item->user_id}}" required="true" name="userid">
                                            <button class="btn btn-danger" title="Distributor Block"><i class="fa fa-ban"></i></button>
                                        </form>
                                        <form action="{{url('admin/unBlockDistributor')}}" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" value="{{$item->user_id}}" required="true" name="userid">
                                            <button class="btn btn-success" title="Distributor Un-Block"><i class="fa fa-check-circle"></i></button>
                                        </form>
                                    </td>
                                 </tr>
                                @endforeach --}}
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
