@extends('schooladmin.layouts.master')
@section('title','Set Exam Schedule')
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
                            <li class="breadcrumb-item"><a href="{{url('schooladmin/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="card col-sm-6 p-0">
                <div class="card-header bg-warning">
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
                    <form action="{{route('schooladmin.exam_schedules')}}" method="post" class="row">
                        @csrf
                        <div class="form-group col-sm-6 mb-2">
                            <label for="class">Select Class <star>*</star></label>
                            <select name="class" id="class" class="form-select">
                                <option value="" selected disabled>--Select Class--</option>
                                @foreach ($classlist as $item)
                                    <option value="{{$item->id}}">{{$item->class_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger form-text">@error('class'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                            <label for="examdate">Select Exam Date <star>*</star></label>
                            <input type="date" name="examdate" id="examdate" required class="form-control">
                            <span class="text-danger form-text">@error('examdate'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                            <label for="examtimefrom">Select Exam Time From <star>*</star></label>
                            <input type="time" name="examtimefrom" id="examtimefrom" required class="form-control">
                            <span class="text-danger form-text">@error('examtimefrom'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-6 mb-2">
                            <label for="examtimeto">Select Exam Time To <star>*</star></label>
                            <input type="time" name="examtimeto" id="examtimeto" required class="form-control">
                            <span class="text-danger form-text">@error('examtimeto'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-12 mb-2">
                            <label for="examcenter">Enter Exam Center <star>*</star></label>
                            <textarea name="examcenter" id="examcenter" class="form-control" placeholder="Enter exam center name with full address."></textarea>
                            <span class="text-danger form-text">@error('examtimeto'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-sm-12 mb-2 text-center">
                            <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
