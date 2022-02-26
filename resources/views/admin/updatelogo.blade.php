@extends('admin.layouts.master')
@section('title', 'Update Logo')
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
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-header bg-info text-white">Header Logo</div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('uploadHeaderLogo') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="headerlogo">Select Header Picture <star>*</star></label>
                                                        <input class="form-control" id="headerlogo" type="file" name="headerlogo" />
                                                        <small class="form-text text-danger">@error('headerlogo') {{$message}} @enderror</small>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" name="headerlogo" class="btn btn-info btn-sm">Submit</button>
                                                    </div>
                                                </form>
                                                <img style="height:80px;" src="" id="headerlogoview">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-header bg-danger text-white">Footer Logo</div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('uploadFooterLogo') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="footerlogo">Select Footer Logo <star>*</star></;>
                                                        <input class="form-control" id="footerlogo" type="file" name="footerlogo" />
                                                        <small class="form-text text-danger">@error('footerlogo') {{$message}} @enderror</small>
                                                    </div>
                                                    <div class="form-group text-center ">
                                                        <button type="submit" name="footerlogo" class="btn btn-danger btn-sm">Submit</button>
                                                    </div>
                                                </form>
                                                <img style="height:80px;" src="" id="footerlogoview">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Favicon</div>
                                            <div class="card-body">
                                                <form method="post" action="{{ route('uploadFaviconLogo') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="faviconlogo">Select Favicon <star>*</star></label>
                                                        <input class="form-control" id="faviconlogo" type="file" name="faviconlogo" />
                                                        <small class="form-text text-danger">@error('faviconlogo') {{$message}} @enderror</small>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="submit" name="faviconlogo"class="btn btn-primary btn-sm">Submit</button>
                                                    </div>
                                                </form>
                                                <img style="height:80px;" src="" id="faviconlogoview">
                                            </div>
                                        </div>
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

    <script type="text/javascript">
        headerlogo.onchange = evt => {
            const [file] = headerlogo.files
            if (file) {
                headerlogoview.src = URL.createObjectURL(file);
            }
        }

        footerlogo.onchange = evt => {
            const [file] = footerlogo.files
            if (file) {
                footerlogoview.src = URL.createObjectURL(file);
            }
        }

        faviconlogo.onchange = evt => {
            const [file] = faviconlogo.files
            if (file) {
                faviconlogoview.src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection
