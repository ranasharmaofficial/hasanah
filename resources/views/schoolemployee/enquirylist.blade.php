@extends('schoolemployee.layouts.master')
@section('title','Enquiry List')
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

                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0">Total Enquiry: <b>{{$enquirylists->total();}}</b>, Page No: <b>{{$enquirylists->currentPage();}}</b></p>
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Enquiry Date</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquirylists as $key => $enquirylist)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$enquirylist->name}}</td>
                                    <td>{{$enquirylist->email}}</td>
                                    <td>{{$enquirylist->message}}</td>
                                    <td>{{$enquirylist->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end">
                            {{$enquirylists->links();}}
                        </ul>                                
                    </nav>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
