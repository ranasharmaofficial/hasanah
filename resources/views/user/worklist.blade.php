@extends('user.layouts.master')
@section('title','Work List')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Project Request</a></li>
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
                    <div class="card-header bg-info">
                        <h4 class="card-title text-white">@yield('title')</h4>
                        <p class="p-0 m-0 text-white">Total Project: <b>{{$worklist->total();}}</b>, Page No: <b>{{$worklist->currentPage();}}</b></p>
                        
                    </div>
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Project Id</th>
                                <th>Project Name</th>
                                <th>Company Name</th>
                                <th>Project Category</th>
                                <th>Project Amount</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                               
                            @foreach ($worklist as $key => $item)
                            <tr>
                                <td>{{($worklist->currentpage()-1) * $worklist->perpage() + $key + 1}}.</td>
                                <td>{{$item->project_id}}</td>
                                <td>{{$item->project_name}}</td>
                                <td>{{$item->company_name}}</td>
                                <td>{{$item->project_category}}</td>
                                <td>Rs {{$item->project_amount}}</td>
                               <td>{{$item->created_at}}</td>
                                <td>
                                    <form method="post" action="{{route('user.workdetails')}}">
                                        @csrf
                                        <input type="hidden" name="projectid" value="{{$item->project_id}}">
                                        <button type="submit"  class="btn btn-success btn-sm">View Details</button>
                                    </form><hr>
                                    <button class="btn btn-danger btn-sm">Block</button>
                                </td>
                            </tr>
                           
                            @endforeach
                            <tr>
                                <td colspan="7">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{$worklist->links();}}
                                        </ul>
                                    </nav>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
