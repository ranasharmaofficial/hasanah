@extends('schoolemployee.layouts.master')
@section('title','Receive Mess Payment')
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
        
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">@yield('title')</h3>
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
                        <form action="{{route('schoolemployee.mess.receiveMessPayment')}}" method="post" class="row" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="studentid" value="{{$getdetails->student_id}}" required />
                            <input type="hidden" name="received_by" value="{{ $LoggedSchoolEmployeeInfo['user_id'] }}" required />
                            <div class="form-group col-sm-6 mb-2">
                                <label for="name">Student Name</label>
                                <input type="text" required readonly placeholder="Student Name" name="name" value="{{$studentdetails->name}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="admission_number">Admission Number</label>
                                <input type="text" required readonly placeholder="Admission Number" name="admission_number" value="{{$getdetails->admission_number}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="roll_number">Roll Number</label>
                                <input type="text" required readonly placeholder="Roll Number" name="roll_number" value="{{$getdetails->roll_number}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="session">Session</label>
                                <input type="text" required readonly placeholder="Session" name="session" value="{{$getdetails->session}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="hostel_fee">Total Mess Fee Per Month (In rupees)</label>
                                <input type="text" required readonly placeholder="Mess Fee Per Month" name="mess_fee" value="{{$getdetails->mess_fee}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="paid_amount">Paid Amount (In rupees)</label>
                                <input type="text" required readonly placeholder="Paid Amount" name="paid_amount" value="{{$getdetails->paid_amount}}" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="month">Select Month</label>
                                <input type="month" required placeholder="Select Month" name="month" class="form-control">
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="amount">Enter amount to paid (In rupees)</label>
                                <input type="tel" required placeholder="Enter Amount to paid" name="amount" value="" class="form-control">
                            </div>
                            <div class="form-group col-xs-12 mb-2 text-center">
                                <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
