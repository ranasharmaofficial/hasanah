@extends('schoolemployee.layouts.master')
@section('title','Admit in mess')
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
                    <div class="card-header bg-success">
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
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <img src="{{asset('uploads/student-documents').'/'.$studentdetails->studentPhoto}}" alt="{{$studentdetails->name}}" style="width: 200px; height: 200px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Roll Number: </th>
                                    <td>{{$studentdetails->rollNumber}}</td>
                                    <th>Admission Number: </th>
                                    <td>{{$studentdetails->admissionNumber}}</td>
                                </tr>
                                <tr>
                                    <th>Name: </th>
                                    <td>{{$studentdetails->name}}</td>
                                    <th>Mobile Number: </th>
                                    <td>{{$studentdetails->mobile}}</td>
                                </tr>                                
                            </tbody>
                        </table>
                        
                        <form action="{{route('schoolemployee.mess.admitInMess')}}" class="row" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-sm-6 mb-2">
                                <select name="session" id="session" title="Session" required class="form-select">
                                    <option value="" selected disabled>--Select Session--</option>
                                    @foreach ($sessions as $session)
                                        <option value="{{$session->academicYear}}">{{$session->academicYear}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-danger">@error('session')
                                    {{$message}}
                                @enderror</span>
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <select name="veg_non_veg" id="veg_non_veg" title="Select Veg/Non-veg" required class="form-select">
                                    <option value="" selected disabled>--Select Veg/Non-veg--</option>
                                    <option value="Vegetarian">Vegetarian</option>
                                    <option value="Non-Vegetarian">Non-Vegetarian</option>
                                </select>
                                <span class="form-text text-danger">@error('veg_non_veg')
                                    {{$message}}
                                @enderror</span>
                            </div>
                            <div class="form-group col-sm-12 mb-2">
                                <input type="text" placeholder="Enter Mess Fee (Per Month)" name="mess_fee" title="Enter Mess Fee (Per Month)" id="mess_fee" required autocomplete="off" class="form-control" />
                                <span class="form-text text-danger">@error('mess_fee')
                                    {{$message}}
                                @enderror</span>
                            </div>
                            <input type="hidden" name="admissionno" value="{{$studentdetails->admissionNumber}}" required />
                            <input type="hidden" name="studentid" value="{{$studentdetails->student_id}}" required />
                            <input type="hidden" name="rollnumber" value="{{$studentdetails->rollNumber}}" required />
                            <div class="form-group col-sm-12 text-center">
                                <button type="submit" class="btn btn-secondary"><i class="fa fa-save"></i>&nbsp;Admit Now</button>
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
