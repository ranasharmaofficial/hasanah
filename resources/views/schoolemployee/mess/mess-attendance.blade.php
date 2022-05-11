@extends('schoolemployee.layouts.master')
@section('title','Mess Attendance')
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

            @if (!$showing)
                
            <div class="col-sm-4">
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
                        <form action="{{route('schoolemployee.mess.messAttendanceShow')}}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-xs-12 mb-2">
                                <label for="roll_number">Enter Roll Number <star>*</star></label>
                                <input type="text" required placeholder="Enter Roll Number" name="roll_number" id="roll_number" class="form-control" />
                                <span class="form-text text-danger">
                                    @error('roll_number')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-xs-12 mb-2 text-center">
                                <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif


            @if ($showing)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-dark text-white card-title">@yield('title')</div>
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
                    <div class="card-body">
                        <form action="{{route('schoolemployee.mess.makeAttendance')}}" method="post" class="row">
                            @csrf
                            <input type="hidden" name="studentid" value="{{$attendanceshow->student_id}}" required />
                            <div class="form-group col-sm-6 mb-2">
                                <label for="name">Name</label>
                                <input type="text" readonly required value="{{$attendanceshow->name}}" name="name" required class="form-control" />
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="roll_number">Roll Number</label>
                                <input type="text" readonly required value="{{$attendanceshow->roll_number}}" name="roll_number" required class="form-control" />
                                <span class="form-text text-danger">@error('roll_number') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-sm-12 mb-2">
                                <label for="pa">Present/Absent</label>
                                <select name="present_or_absent" required id="ap" class="form-select">
                                    <option value="" selected disabled>--Select Present/Absent--</option>
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                </select>
                                <span class="form-text text-danger">@error('present_or_absent') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-sm-12 mb-2 text-center">
                                <button class="btn btn-danger" type="button" onclick="window.location.href='{{url('schoolemployee/mess/mess-attendance')}}'"><i class="fa fa-arrow-circle-left"></i> Make Another</button>
                                <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
