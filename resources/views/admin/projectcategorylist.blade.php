@extends('admin.layouts.master')
@section('title','Project Category List')
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
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Project Category ID</th>
                                <th>Category</th>
                                <th>Project Amount</th>
                                <th>Distribute Amount</th>
                                <th>Created At</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach ($projectcategory as $item)
                            <tr>
                                <td>{{$item->project_cat_id}}</td>
                                <td>{{$item->project_category}}</td>
                                <td>{{$item->project_amount}}</td>
                                <td>{{$item->distribute_amount}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                            @endforeach

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
