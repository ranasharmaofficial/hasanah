@extends('admin.layouts.master')
@section('title','Distributor List')
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
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>qualification</th>
                                <th>Dob</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
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
