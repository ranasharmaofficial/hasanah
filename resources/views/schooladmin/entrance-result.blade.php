@extends('schooladmin.layouts.master')
@section('title','Publish Entrance Exam Result')
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
        
        <div class="row justify-content-center">
            @if (!$fetchstudentscheck)
            <div class="col-xs-6">
                <div class="card">
                    <div class="card-header">
                        @yield('title')
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
                        <form action="{{route('schooladmin.entranceExamResult')}}" method="get" class="row">
                            <div class="form-group col-sm-12 mb-2">
                                <label for="class">Select Class</label>
                                <select name="class" id="class" class="form-select" required>
                                    <option value="" selected disabled>--Select Class--</option>
                                    @foreach ($classlists as $classlist)
                                        <option value="{{$classlist->id}}">{{$classlist->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12 mb-2">
                                <label for="subject">Enter Subject Name</label>
                                <input type="text" class="form-control" required placeholder="Enter Subject Name" name="subject" id="subject" />
                            </div>
                            <div class="form-group col-sm-12 text-center">
                                <button type="submit" class="btn btn-secondary"><i class="fa fa-paper-plane"></i>&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
            @endif


            @if ($fetchstudentscheck)
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        @yield('title')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Total Mark</th>
                                        <th>Obtain Mark</th>
                                        <th>Present/Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{route('schooladmin.saveEnteranceResult')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="length" value="{{$fetchstudents->count()}}">
                                    @forelse ($fetchstudents as $key => $fetchstudent)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><input type="tel" required placeholder="Enter Total Mark" name="student_id[]" id="student_id[]" class="form-control" readonly value="{{$fetchstudent->student_id}}" /></td>
                                        <td><input type="tel" required placeholder="Enter Total Mark" name="name[]" id="name[]" class="form-control" readonly value="{{$fetchstudent->name}}" /></td>
                                        <td><input type="tel" required placeholder="Enter Total Mark" name="subject[]" id="subject[]" class="form-control" readonly value="{{$subject}}" /></td>
                                        <td><input type="tel" required placeholder="Enter Total Mark" name="total_mark[]" id="total_mark[]" class="form-control" /></td>
                                        <td><input type="tel" required placeholder="Enter Obtain Mark" name="obtain_mark[]" id="obtain_mark[]" class="form-control" /></td>
                                        <td>
                                            <select name="ap[]" id="ap[]" class="form-select" required>
                                                <option value="Present" class="text-success">Present</option>
                                                <option value="Absent" class="text-danger">Absent</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr class="text-center">
                                            <th class="text-danger" colspan="7">Data Not Availabel</th>
                                        </tr>
                                    @endforelse
                                    <tr class="text-center">
                                        <td colspan="7">
                                            <button class="btn btn-danger"><i class="fa fa-save"></i>&nbsp;Save Result</button>
                                        </td>
                                    </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif



        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
