@extends('admin.layouts.master')
@section('title','Project List')
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
                    <div class="card-header bg-primary">
                        <form action="{{ route('admin.project-list') }}" method="GET">
                            <div class="form-group row offset-lg-2">
                                <label class="col-md-3 col-form-label text-white">Sort by Company</label>
                                <div class="col-md-5">
                                    <select id="demo-ease" class="form-control" name="company_id" required>
                                        <option value="0">--Select Company--</option>
                                        @foreach ($companies as $key => $company)
                                           <option value="{{ $company->company_id }}" @if($sort_by == $company->company_id) selected @endif>{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger" type="submit">Filter</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ url('admin/project-list') }}" class="btn btn-warning">Refresh</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        {{-- <form method="get" style="float: right;">
                            <div class="app-search">
                                <input name="search" value="" type="text" class="form-control" placeholder="Search here...">
                                <span id="search_icons" class="ri-search-line"></span>
                            </div>
                        </form> --}}
                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0 text-white">Total Category: <b>{{$projects->total();}}</b>, Page No: <b>{{$projects->currentPage();}}</b></p>
                        <div class="table-responsive">
                            <table  id="datatable"  class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th><b>Sl.No.</b></th>
                                    <th><b>Created At</b></th>
                                    <th><b>Project ID</b></th>
                                    <th><b>Project Number</b></th>
                                    <th><b>Project Category</b></th>
                                    <th><b>Project Name</b></th>
                                    <th><b>Company Name</b></th>
                                    <th><b>Order Status</b></th>
                                    <th><b>Unit Price</b></th>
                                    <th><b>Address</b></th>
                                    <th><b>Contractor Name</b></th>
                                    <th><b>Distributor Name</b></th>
                                    <th><b>Submit Date</b></th>
                                    <th><b>Company Name</b></th>
                                    <th><b>Days to Go</b></th>
                                    <th><b>Project Status</b></th>
                                    <th><b>Google Location</b></th>
                                    <th><b>Google Link</b></th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $s=1;
                                    @endphp
                                    @foreach ($projects as $key => $item)
                                    @php
                                        $dist_id = App\Models\Distributor::where('distributor_reg',$item->distributor_id)->pluck('user_id')->first();
                                        $dist_name = App\Models\User::where('user_id',$dist_id)->pluck('name')->first();
                                        //  dd($dist_name);

                                    @endphp
                                        <tr>
                                            <td>{{$s++}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->project_id}}</td>
                                            <td>{{$item->project_number}}</td>
                                            <td>{{$item->pro_category->project_category}}</td>
                                            <td>{{$item->project_name}}</td>
                                            <td>{{$item->get_company_name->company_name}}</td>
                                            <td>{{$item->project_type}}</td>
                                            <td>{{$item->currency}} {{$item->amount}}</td>
                                            <td>Addres</td>
                                            <td>cont</td>
                                            <td>{{ $dist_name }}</td>
                                            <td>submit date</td>
                                            <td>{{$item->get_company_name->company_name}}</td>
                                            
                                            <td>days to go</td>
                                            <td>@if($item->project_status==1)
                                                <span class="text-danger">Pending</span>
                                                @elseif ($item->project_status==2)
                                                <span class="text-info">Ongoing</span>
                                                @elseif ($item->project_status==3)
                                                <span class="text-success">Completed</span>
                                                @elseif ($item->project_status==4)
                                                <span class="text-info">Approved by Distributor</span>
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
