@extends('schoolemployee.layouts.master')
@section('title','Event List')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
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
                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0">Total Events: <b>{{$eventlists->total();}}</b>, Page No: <b>{{$eventlists->currentPage();}}</b></p>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Event&nbsp;Name</th>
                                    <th>Event&nbsp;Title</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($eventlists as $key => $datas)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$datas->eventName}}</td>
                                    <td>{{$datas->eventTitle}}</td>
                                    <td>{{$datas->slug}}</td>
                                    <td>{{$datas->created_at}}</td>
                                    <td>
                                        @if ($datas->updated_at !== null)
                                        {{$datas->updated_at}}
                                        @else 
                                        Null
                                        @endif
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" onclick="showDetails(this)" id="{{$datas->eventID}}">Event&nbsp;Details</button></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                                {{$eventlists->links();}}
                            </ul>                                
                        </nav>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
