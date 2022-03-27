@extends('user.layouts.master')
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
                            <li class="breadcrumb-item"><a href="{{url('user/home')}}">User Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@yield('title')</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Project&nbsp;Name</th>
                                    <th>Project&nbsp;Number</th>
                                    <th>Project&nbsp;Status</th>
                                    <th>Project&nbsp;Amount</th>
                                    <th>Days&nbsp;to&nbsp;Go</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($userProjects as $key => $data)
                                <tr>
                                    <td>{{($userProjects->currentpage()-1) * $userProjects->perpage() + $key + 1}}</td>
                                    <td>{{$data->company_name}}</td>
                                    <td>{{$data->project_category}}</td>
                                    <td>{{$data->project_name}}</td>
                                    <td>{{$data->project_number}}</td>
                                    <td>Ongoing</td>
                                    <td>Rs&nbsp;{{$data->project_amount}}</td>
                                    <td>{{$data->no_of_days}}</td>
                                    
                                    <td>
                                        <a href="{{url('user/upload-image')}}"><button class="btn btn-info btn-sm">Upload&nbsp;Image</button></a>
                                        <a href="{{url('user/upload-video')}}"><button class="btn btn-success btn-sm">Upload&nbsp;Video</button></a>
                                        <button class="btn btn-danger btn-sm">View&nbsp;Details</button>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                {{$userProjects->links();}}
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
