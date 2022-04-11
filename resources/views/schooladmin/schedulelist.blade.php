@php
use \App\Http\Controllers\SchoolAdminController;
@endphp
@extends('schooladmin.layouts.master')
@section('title','Exam Schedule List')
@section('content')
<style>
table.border-modal{
    border:1px solid blue;
    margin-top:20px;
  }
table.border-modal > thead > tr > th{
    border:1px solid rgb(156, 231, 206);
}
table.border-modal > tbody > tr > th{
    border:1px solid rgb(156, 231, 206);
}
table.border-modal > tbody > tr > td{
    border:1px solid rgb(156, 231, 206);
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
                    <div class="card-header bg-danger rounded">
                        <h3 class="card-title text-white">@yield('title')</h3>
                        <p class="p-0 m-0 text-white">Total Class: <b>{{$schedulelist->total();}}</b>, Page No: <b>{{$schedulelist->currentPage();}}</b></p>
                    </div>
                    <div class="card-body table-responsive">                        
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-dark">
                            <tr>
                                <th>Sl. No.</th>
                                <th>Exam</th>
                                <th>Class</th>
                                <th>Exam Date</th>
                                <th>Exam Timing</th>
                                <th>Exam Center</th>
                                <th>Created At</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($schedulelist as $key => $data)
                            <tr>
                                <td>{{($schedulelist->currentpage()-1) * $schedulelist->perpage() + $key + 1}}</td>
                                <td>{{$data->exam_name}}</td>
                                <td>{{SchoolAdminController::getClassName($data->class)}}</td>
                                <td>{{$data->exam_date}}</td>
                                <td>{{$data->exam_time_from}} - {{$data->exam_time_to}}</td>
                                <td>{{$data->exam_center}}</td>
                                <td>{{$data->created_at->format('d-M-Y')}}</td>
                                {{-- <td class="text-center">
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
                                    <button type="button" class="btn btn-info d-inline" title="View Details" onclick="showDetails(this)" id="{{$data->user_id}}"><i class="fa fa-eye"></i></button>
                                </td> --}}
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{$schedulelist->links();}}
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
