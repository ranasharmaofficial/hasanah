@extends('schoolemployee.layouts.master')
@section('title','Mess Fee Details')
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

            @if (!$showing)
                
            <div class="col-sm-4">
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
                        <form action="{{route('schoolemployee.mess.messFeeDetails')}}" method="get" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-xs-12 mb-2">
                                <label for="roll_number">Enter Roll Number <star>*</star></label>
                                <input type="text" required placeholder="Enter Roll Number" name="roll_number" id="roll_number" class="form-control" />
                                <span class="form-text text-danger">
                                    @error('roll_number')
                                        {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-xs-12 mb-2 text-center">
                                <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif


            @if ($showing)
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark text-white card-title">@yield('title')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-triped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Roll Number</th>
                                        <th>Name</th>
                                        <th>Received Amount</th>
                                        <th>Received Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getstudentdetails as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->roll_number}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->receive_amount}}/-</td>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Results Not Found</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
