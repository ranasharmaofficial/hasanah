@extends('admin.layouts.master')
@section('title','Update Social Media Links')
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
                @if ($sociallink)
                <form method="post" action="{{route('updateSocialLinks')}}" class="row" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$sociallink->id}}" name="socialid" required>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Facebook">Facebook <star>*</star></label>
                            <input class="form-control" placeholder="https://facebook.com/prabuddham-academy" id="facebook" value="{{$sociallink->facebook}}" type="text" name="facebook" />
                            <small class="text-danger form-text">@error('facebook') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Twitter">Twitter</label>
                            <input class="form-control" placeholder="https://twitter.com/prabuddham-academy" id="twitter" value="{{$sociallink->twitter}}" type="text" name="twitter" />
                            <small class="text-danger form-text">@error('twitter') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Instagram">Instagram <star>*</star></label>
                            <input placeholder="https://instagram.com/prabuddham-academy" class="form-control" id="instagram" value="{{$sociallink->instagram}}" type="text" name="instagram" />
                            <small class="text-danger form-text">@error('instagram') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="address">LinkedIn</label>
                            <input placeholder="https://linkedin.com/prabuddham-academy" class="form-control" id="linkedin" value="{{$sociallink->linkedin}}" type="text" name="linkedin" />
                            <small class="text-danger form-text">@error('linkedin') {{$message}} @enderror</small>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3 text-center">
                        <button type="submit" name="uploadSocialLink" class="btn btn-danger">Update Social Links</button>
                    </div>
                </form>
                @else
                <form method="post" action="{{route('uploadsociallinks')}}" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Facebook">Facebook <star>*</star></label>
                            <input class="form-control" placeholder="https://facebook.com/prabuddham-academy" id="facebook" value="{{old('facebook')}}" type="text" name="facebook" />
                            <small class="text-danger form-text">@error('facebook') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Twitter">Twitter</label>
                            <input class="form-control" placeholder="https://twitter.com/prabuddham-academy" id="twitter" value="{{old('twitter')}}" type="text" name="twitter" />
                            <small class="text-danger form-text">@error('twitter') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="Instagram">Instagram <star>*</star></label>
                            <input placeholder="https://instagram.com/prabuddham-academy" class="form-control" id="instagram" value="{{old('instagram')}}" type="text" name="instagram" />
                            <small class="text-danger form-text">@error('instagram') {{$message}} @enderror</small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="address">LinkedIn</label>
                            <input placeholder="https://linkedin.com/prabuddham-academy" class="form-control" id="linkedin" value="{{old('linkedin')}}" type="text" name="linkedin" />
                            <small class="text-danger form-text">@error('linkedin') {{$message}} @enderror</small>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3 text-center">
                        <button type="submit" name="uploadSocialLink" class="btn btn-primary">Upload Social Links</button>
                    </div>
                </form>
                @endif                
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection