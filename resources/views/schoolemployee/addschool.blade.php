@extends('schoolemployee.layouts.master')
@section('title','Add School')
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
                            <li class="breadcrumb-item"><a href="{{url('schoolemployee/home')}}">Dashboard</a></li>
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
                                <form action="{{route('schoolemployee.uploadSchool')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <label for="schoolname" class="col-form-label">School Name <star>*</star></label>
                                        <input class="form-control" type="text" name="schoolname" required placeholder="School Name" id="schoolname" value="{{old('schoolname')}}">
                                        <small class="text-danger form-text">@error('schoolname') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_school" type="submit" class="btn btn-primary btn-sm">Submit Details</button>
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
