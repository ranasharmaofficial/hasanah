@extends('schooladmin.layouts.master')
@section('title','Add Academic Year')
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
                            <li class="breadcrumb-item"><a href="{{url('schooladmin/home')}}">Dashboard</a></li>
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
                        <div class="container">
                            <div class="row mb-3">
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
                                <form action="{{route('uploadAcademicYear')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-4">
                                        <label for="datefrom" class="col-form-label">Academic Year From <star>*</star></label>
                                        <input class="form-control" type="number" name="datefrom" placeholder="XXXX" min="2021" required id="datefrom" value="{{old('datefrom')}}">
                                        <small class="text-danger form-text">@error('datefrom') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="dateto" class="col-form-label">Academic Year To <star>*</star></label>
                                        <input class="form-control" type="number" placeholder="XXXX" name="dateto" min="2021" required id="dateto" value="{{old('dateto')}}">
                                        <small class="text-danger form-text">@error('dateto') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_academic_year" type="submit" class="btn btn-info">Submit Academic Year</button>
                                    </div>
                                </form>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
