@extends('schooladmin.layouts.master')
@section('title','Add Class')
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
                                <form action="{{route('uploadClass')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <label for="className" class="col-form-label">Class Name <star>*</star></label>
                                        <input class="form-control" type="text" name="classname" required placeholder="Class Name" id="className" value="{{old('coursename')}}">
                                        <small class="text-danger form-text">@error('classname') {{$message}} @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="ClassAmount" class="col-form-label">Amount <star>*</star></label>
                                        <input class="form-control" type="text" name="classamount" required placeholder="Class Amount" id="ClassAmount" value="{{old('coursetitle')}}">
                                        <small class="text-danger form-text">@error('classamount') {{$message}} @enderror</small>
                                    </div>
                                    
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_class" type="submit" class="btn btn-primary btn-sm">Submit Class Details</button>
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
