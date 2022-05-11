@extends('schooladmin.layouts.master')
@section('title','Admission Fee List')
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
                    <div class="card-header bg-danger">
                        <h4 class="card-title text-white">@yield('title')</h4>
                        <p class="p-0 m-0 text-white">Total @yield('title'): <b>{{$admissionfeelist->total();}}</b>, Page No: <b>{{$admissionfeelist->currentPage();}}</b></p>
                    </div>
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Class</th>
                                    <th>Admission Fee</th>
                                    <th>Tution Fee</th>
                                    <th>Security Deposit</th>
                                    <th>Annual Fee</th>
                                    <th>Miscellanous Fee</th>
                                    <th>Created At</th>
                                 </tr>
                                </thead>
                                <tbody>
                                @foreach ($admissionfeelist as $key => $datas)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$datas->className}}</td>
                                    <td>Rs&nbsp;{{$datas->admission_fee}}</td>
                                    <td>Rs&nbsp;{{$datas->tution_fee}}</td>
                                    <td>Rs&nbsp;{{$datas->security_deposit}}</td>
                                    <td>Rs&nbsp;{{$datas->annual_fee}}</td>
                                    <td>Rs&nbsp;{{$datas->miscellanous_fee}}</td>
                                    <td>{{$datas->created_at}}</td>
                                    
                                 </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                                {{$admissionfeelist->links();}}
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
