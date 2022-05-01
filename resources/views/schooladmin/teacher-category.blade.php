@extends('schooladmin.layouts.master')
@section('title','Add Teacher Category')
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
                            <li class="breadcrumb-item"><a href="{{asset('admin/home')}}">Dashboard</a></li>
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
                        <form action="{{route('uploadTeacherCategory')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="card-title font-weight-bold text-uppercase">Teacher Category:-</h4><hr>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <label for="teachercategory" class="col-form-label">Teacher Category <star>*</star></label>
                                        <input class="form-control" type="text" name="teacher_category" placeholder="Enter Teacher Category" id="teachercategory">
                                        <span class="form-text text-danger">@error('teacher_category') {{$message}} @enderror</span>
                                    </div>

                                    <div class="col-sm-12 text-center mt-3">
                                        <button name="add_teacher" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Upload Teacher Category</button>
                                    </div>
                                </div>                                
                            </div>                            
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
