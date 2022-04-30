@extends('student.layouts.master')
@section('title', 'Pay Admission Fee')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .razorpay-payment-button {
        color: white !important;
        background-color: #A4139D;
        border-color: #A4139D;
        font-size: 14px;
        width: 100%;
        height: 45px;
        text-align: center;
        border-radius: 2px;
        padding: 10px;
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
                                        <th>Name:</th>
                                        <td>{{$studentdata->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Roll Number:</th>
                                        <td>{{$feedata->rollNumber}}</td>
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
                                        <th>Security Deposit:</th>
                                        <td>Rs: {{$feedata->security_deposit}}/-</td>
                                    </tr>
                                    <tr>
                                        <th>Annual Fee:</th>
                                        <td>Rs: {{$feedata->annual_fee}}/-</td>
                                    </tr>
                                    <tr>
                                        <th>Miscellanous Fee:</th>
                                        <td>Rs: {{$feedata->miscellanous_fee}}/-</td>
                                    </tr>
                                    <tr>
                                        <th>Total Payment:</th>
                                        <td>Rs: {{$feedata->admissionFee + $feedata->tutionFee + $feedata->security_deposit + $feedata->annual_fee + $feedata->miscellanous_fee}}/-</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td colspan="2">
                                            <div class="row justify-content-center">
                                                <div class="col-sm-2">
                                                    <form action="{{url('admissionPayment')}}" method="POST" >
                                                        @csrf
                                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                                            data-amount="{{$feedata->admissionFee + $feedata->tutionFee + $feedata->security_deposit + $feedata->annual_fee + $feedata->miscellanous_fee}}00"
                                                            data-buttontext="Pay Now"
                                                            data-name="Hasanah Educational Trust"
                                                            data-description="Admission Payment"
                                                            data-image="{{asset('assets_admin/images/logo-light.png')}}"
                                                            data-prefill.name="{{$studentdata->name}}"
                                                            data-prefill.email="{{$studentdata->email}}"
                                                            data-prefill.contact="{{$studentdata->mobile}}"
                                                            data-theme.color="#A4139D">
                                                        </script>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
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
