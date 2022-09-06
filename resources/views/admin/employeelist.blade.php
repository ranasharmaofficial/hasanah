@extends('admin.layouts.master')
@section('title','Employee List')
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
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered dt-responsive nowrap" id="datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th>Sl.No</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>User ID</th>
                                <th>Password</th>
                                <th>Mobile</th>
                                <th>Date of Joining</th>
                                <th>Action</th>
                              </tr>
                            </thead>


                            <tbody>
                                @php
                                $s=1;
                            @endphp 
                                @foreach ($employee as $item)
                                <tr>
                                    <td>{{$s++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->company_ka_name }}</td>
                                    <td>{{$item->user_id}}</td>
                                    <td>{{$item->password}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupVerticalDrop1" type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                <a class="dropdown-item" href="{{ url('admin/view-employee/'.$item->employee_id) }}">View Details</a>
                                                <a class="dropdown-item" href="{{ url('admin/edit-employee/'.$item->employee_id) }}">Edit Details</a>
                                                {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                                            </div>
                                        </div>
                                    </td>
                                 </tr>
                                @endforeach
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
