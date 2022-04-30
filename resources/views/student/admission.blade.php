@extends('student.layouts.master')
@section('title', 'Admission Form')
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
        
        <div class="row justify-content-center">
            <div class="col-xs-6">
                <div class="row">
                    <div class="card col-xs-6 text-center" style="background: #FEF4F2;">
                        <div class="card-body">
                            <h4>Admission Form</h4>
                            @if ($admissionstatus == null)
                            <p>Status: <span class="text-danger">Now Applied</span></p>
                            <a href="{{url('student/admission-form')}}" class="btn btn-primary">Apply Now</a>
                            @elseif ($admissionstatus->status == '2')                                
                            <p>Status: <span class="text-warning">Admission fee not paid</span></p>
                            <a href="{{url('student/admission-fee')}}" class="btn btn-primary">Pay Now</a>
                            @elseif ($admissionstatus->status == '1')                                
                            <p>Status: <span class="text-success">Form Applied</span></p>
                            <a href="{{url('student/admission-receiept').'/'.$admissionstatus->student_id}}" class="btn btn-primary">Download admission slip</a>
                            @endif
                        </div>
                    </div>
                    <div class="card col-xs-6 text-center" style="background: #f3fef2;">
                        <div class="card-body">
                            <h4>Admission Fee</h4>
                            @if ($admissionstatus == null)
                            <p>Status: <span class="text-danger">Now Applied</span></p>
                            <a href="{{url('student/admission-form')}}" class="btn btn-primary">Apply Now</a>
                            @elseif ($admissionstatus->status == '2')                                
                            <p>Status: <span class="text-warning">Admission fee not paid</span></p>
                            <a href="{{url('student/admission-fee')}}" class="btn btn-primary">Pay Now</a>
                            @elseif ($admissionstatus->status == '1')                                
                            <p>Status: <span class="text-success">Fee paid</span></p>
                            <a href="{{url('student/admission-payment-receipt').'/'.$admissionstatus->student_id}}" class="btn btn-primary">Download payment slip</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
