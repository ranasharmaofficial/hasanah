@extends('student.layouts.master')
@section('title', 'Pay Admission Fee')
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
                            <li class="breadcrumb-item"><a href="{{url('student/home')}}">Dashboard</a></li>
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
                    <div class="card-header">
                        <h3 class="card-title">@yield('title')</h3>
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
                        @if ($feedata == null)
                            <h5 class="text-danger">Please! Fill Admission form first.</h5>
                        @else
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Roll Number:</th>
                                        <td>{{$feedata->rollNumber}}</td>
                                    </tr>
                                    <tr>
                                        <th>Name:</th>
                                        <td>{{$studentdata->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Form Applied Date:</th>
                                        <td>{{$feedata->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Admission Fee:</th>
                                        <td>Rs: {{$feedata->admissionFee}}/-</td>
                                    </tr>
                                    <tr>
                                        <th>Tution Fee:</th>
                                        <td>Rs: {{$feedata->tutionFee}}/-</td>
                                    </tr>
                                    <tr>
                                        <th>Total Payment:</th>
                                        <td>Rs: {{$feedata->admissionFee + $feedata->tutionFee}}/-</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2"><button class="btn btn-danger">Pay Now</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
