@extends('schoolemployee.layouts.master')
@section('title','Add Stock')
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
        
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">@yield('title')</h3>
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
                        <form action="{{route('schoolemployee.mess.insertDish')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-xs-12 mb-2">
                                <label for="dish">Enter Dish <star>*</star></label>
                                <input type="text" class="form-control" required placeholder="Enter Dish" name="dish" id="dish" autocomplete="off" />
                                <span class="form-text text-danger">
                                    @error('dish')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-xs-12 mb-2 text-center">
                                <button class="btn btn-secondary"><i class="fa fa-paper-plane"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
