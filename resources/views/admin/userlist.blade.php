@extends('admin.layouts.master')
@section('title','User List')
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
                    <div class="card-header bg-danger">
                        <h3 class="card-title text-white">@yield('title')</h3>
                        <p class="p-0 m-0 text-white">Total User: <b>{{$userdatas->total();}}</b>, Page No: <b>{{$userdatas->currentPage();}}</b></p>
                    </div>
                    <div class="card-body">                        
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($userdatas as $key => $data)
                            <tr>
                                <td>{{($userdatas->currentpage()-1) * $userdatas->perpage() + $key + 1}}</td>
                                <td>{{$data->user_id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->mobile}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->created_at->format('d-m-Y')}}</td>
                                <td class="text-center">
                                    @if ($data->status == 0)
                                    <form action="{{route('unBlockUserContract')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i>&nbsp;Un-Block</button>
                                    </form>
                                    @else
                                    <form action="{{route('blockUserContract')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i>&nbsp;Block</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    <div class="card-footer py-4 bg-secondary">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{$userdatas->links();}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
