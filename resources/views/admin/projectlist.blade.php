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
                                        @foreach ($companies as $key => $company)
                                            <option value="{{ $company->company_id }}" @if($sort_by == $company->company_id) selected @endif>{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger" type="submit">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        
                        <h4 class="card-title">@yield('title')</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="bg-dark text-white">
                                <tr>
                                    <th><b>Project ID</b></th>
                                    <th><b>Project Category</b></th>
                                    <th><b>Project Name</b></th>
                                    <th><b>Company Name</b></th>
                                    <th><b>Project Amount</b></th>
                                    <th><b>Created At</b></th>
                                </tr>
                                </thead>
    
    
                                <tbody>
                                @foreach ($projects as $item)
                                <tr>
                                    <td>{{$item->project_id}}</td>
                                    <td>{{$item->pro_category->project_category}}</td>
                                    <td>{{$item->project_name}}</td>
                                    <td>{{$item->get_company_name->company_name}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->created_at}}</td>
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
