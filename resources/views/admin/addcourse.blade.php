@extends('admin.layouts.master')
@section('title','Add Course')
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
                                <form action="{{route('uploadCourseDetails')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <label for="CourseName" class="col-form-label">Course Name <star>*</star></label>
                                        <input class="form-control" type="text" name="coursename" required placeholder="Course Name" id="CourseName" value="{{old('coursename')}}">
                                        <small class="text-danger form-text">@error('coursename') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="CourseTitle" class="col-form-label">Course Title <star>*</star></label>
                                        <input class="form-control" type="text" name="coursetitle" required placeholder="Course Title" id="CourseTitle" value="{{old('coursetitle')}}">
                                        <small class="text-danger form-text">@error('coursetitle') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="coursedetails" class="col-form-label">Course Details <star>*</star></label>
                                        <textarea id="elm1" name="coursedetails">{{old('coursedetails')}}</textarea>
                                        <small class="text-danger form-text">@error('coursedetails') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Course Picture <star>*</star></label>
                                        <input type="file" name="courseimage" class="form-control" required>
                                        <small class="text-danger form-text">@error('courseimage') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_course" type="submit" class="btn btn-info">Submit Course Details</button>
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
