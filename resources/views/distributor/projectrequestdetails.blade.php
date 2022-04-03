@extends('distributor.layouts.master')
@section('title','View Project')
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
                            <li class="breadcrumb-item"><a href="{{'distributor/home'}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        
        @if ($flag)
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Project Request Detail</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>User Name : </th>
                                    <td>{{$userData->name}} </td>
                                </tr>
                                <tr>
                                    <th>Project Category : </th>
                                    <td>{{$projectCatData->project_category}} </td>
                                </tr>
                                <tr>
                                    <th>Company Name : </th>
                                    <td>{{$companyData->company_name}} </td>
                                </tr>
                                <tr>
                                    <th>Beneficiary Name : </th>
                                    <td>{{$project_req_details->beneficiray_name}} </td>
                                </tr>
                                <tr>
                                    <th>Beneficiary Mobile : </th>
                                    <td>{{$project_req_details->beneficiary_mobile	}}  </td>
                                </tr>
                                <tr>
                                    <th>Beneficiary Alt Mobile : </th>
                                    <td>{{$project_req_details->alt_mobile_number}}  </td>
                                </tr>
                                <tr>
                                    <th>Beneficiary Address : </th>
                                    <td>{{$project_req_details->full_address}}  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col sm-12 -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-info text-white">Projects Related to Same Category</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr class="bg-warning">
                                    <th>Sl.&nbsp;No.</th>
                                    <th>Company&nbsp;Name</th>
                                    <th>Project&nbsp;Category</th>
                                    <th>Project&nbsp;Name</th>
                                    <th>Project&nbsp;Number</th>
                                    <th>Project&nbsp;Type</th>
                                    <th>Duration</th>
                                    <th>Project&nbsp;Amount</th>
                                    <th>Created&nbsp;At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($relatedProject as $key => $data)
                                    <tr>
                                        <td>{{($relatedProject->currentpage()-1) * $relatedProject->perpage() + $key + 1}}</td>
                                        <td>{{$data->company_name}}</td>
                                        <td>{{$data->project_category}}</td>
                                        <td>{{$data->project_name}}</td>
                                        <td>{{$data->project_number}}</td>
                                        <td>{{$data->project_type}}</td>
                                        <td>{{$data->no_of_days}}</td>
                                        <td>Rs {{$data->amount}}/-</td>                                       
                                        <td>{{$data->created_at}}</td>
                                        <td>
                                            <form action="{{route('giveProjectAccess')}}" method="post" enctype="multipart/form-data" class="display: inline-block;">
                                                @csrf
                                                <input type="hidden" name="project_id" value="{{$data->project_id}}">
                                                <input type="hidden" name="user_id" value="{{$userData->user_id}}">
                                                <button class="btn btn-success"><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>&nbsp;Assign</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-danger">Project Not Available</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="7">
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-end mb-0">
                                                    {{$relatedProject->links();}}
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col sm-12 -->
             
             
            
        </div>
        <!-- end row -->
		@else
			<div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="" class="row" enctype="multipart/form-data">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="Mobile">Employee Code <star>*</star></label>
                                    <input class="form-control" id="Mobile" required type="text"
                                         name="id" />
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
		@endif
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection