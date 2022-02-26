@extends('admin.layouts.master')
@section('title','Add Notice')
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
                                <form action="{{route('uploadNotice')}}" method="post" class="row" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <label for="NoticeName" class="col-form-label">Notice Name <star>*</star></label>
                                        <input class="form-control" type="text" name="notice_name" required placeholder="Enter Notice Name" id="NoticeName" value="{{old('notice_name')}}">
                                        <small class="form-text text-danger">@error('notice_name')
                                            {{$message}}
                                        @enderror</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="NoticeTitle" class="col-form-label">Notice Title <star>*</star></label>
                                        <input class="form-control" type="text" name="notice_title" required placeholder="Enter Notice Title" id="NoticeTitle" value="{{old('notice_title')}}">
                                        <small class="form-text text-danger">@error('notice_title')
                                            {{$message}}
                                        @enderror</small>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="NoticeDetails" class="col-form-label">Notice Details <star>*</star></label>
                                        <textarea id="elm1" name="details">{{old('details')}}</textarea>
                                        <small class="form-text text-danger">@error('details')
                                            {{$message}}
                                        @enderror</small>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="JoiningDate" class="col-form-label">Notice Picture <star>*</star></label>
                                        <input type="file" name="noticeImage" required class="form-control">
                                        <small class="form-text text-danger">@error('noticeImage')
                                            {{$message}}
                                        @enderror</small>
                                    </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_notice" type="submit" class="btn btn-info"><i class="fa fa-paper-plane"></i> Upload Notice</button>
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
