@extends('user.layouts.master')
@section('title','View Work Details')
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
                            <li class="breadcrumb-item"><a href="{{'home'}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @if ($flag)
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Project Details</div>
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Company Name :</th>
                                    <td>{{$companydata->company_name}}</td>
                                </tr>
                                <tr>
                                    <th>Project ID :</th>
                                    <td>{{$projectdata->project_id}}</td>
                                </tr>
                                <tr>
                                    <th>Project Name :</th>
                                    <td>{{$projectdata->project_name}}</td>
                                </tr>
                                 <tr>
                                    <th>Project Created Date : </th>
                                    <td>{{date('d-M-Y', strtotime($projectdata->created_at))}}  </td>
                                </tr>
                                <tr>
                                    <th>Project Amount : </th>
                                    <td>Rs {{$projectdata->amount}}/- </td>
                                </tr>
                                <tr>
                                    <th>Distributor : </th>
                                    {{-- <td>{{$distributordata->name}} </td> --}}
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('applyForProject')}}" method="post" enctype="multipart/form-data" auctocomplete="off">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$projectdata->project_id}}">
                                    <input type="hidden" name="user_id" value="{{session('LoggedContractUser')}}">
                                <button type="submit" class="btn btn-primary">Apply for This Project</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col sm-6 -->
              
            
        </div>
        <!-- end row -->
        @else
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
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
                        <form method="post" action="{{route('user.workdetails')}}">
                            @csrf
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="Project">Project Id <star>*</star></label>
                                    <input class="form-control" id="Project" required type="text"
                                         name="projectid" />
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Proceed</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        @endif

        

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection