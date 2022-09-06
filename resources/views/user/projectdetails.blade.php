@extends('user.layouts.master')
@section('title', 'Project Details')
@section('content')
    <style>
        star{
            color:red;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">@yield('title')</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Dashboard</a></li>
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
                            <h4 class="card-title text-white">@yield('title')</h4>
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
							<div class="row">
								<div class="col-sm-12">
									<div class="container">
										<div class="row mb-3">
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td>Company</td>
														<td class="text-right">{{$companyData->company_name}}</td>
													</tr>
													<tr>
														<td>Category</td>
														<td class="text-right">{{$projectCatData->project_category}}</td>
													</tr>
													<tr>
														<td>Project&nbsp;Name</td>
														<td class="text-right">{{$projectData->project_name}}</td>
													</tr>
													<tr>
														<td>Project&nbsp;Number</td>
														<td class="text-right">{{$projectData->project_number}}</td>
													</tr>
                                                    <tr>
														<td>Project&nbsp;Status</td>
														<td class="text-right"><h6 class="text-success font-weight-bold">{{$projectData->project_report}}</h6></td>
													</tr>
                                                    <tr>
														<td>Project&nbsp;Amount</td>
														<td class="text-right">{{$projectData->amount}}</td>
													</tr>
                                                    <tr>
														<td>Days&nbsp;to&nbsp;Go</td>
														<td class="text-right">{{$projectData->no_of_days}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div> <!-- end col -->
                            <h4 class="text-primary text-center">Project Realted Images</h4>
                            <div class="row">
                                <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <div class="row g-0">
                                                @foreach ($user_project_images as $item)
                                                <div class="col-xl-4 col-sm-6">
                                                    <div class="product-box">
                                                        <div class="product-img">
                                                            <div class="product-ribbon badge bg-warning">
                                                                Trending
                                                            </div>
                                                            <img src="{{$item->image_url}}" alt="img-1" class="img-fluid mx-auto d-block">
                                                        </div>
                                                        
                                                        <div class="text-center">
                                                            <h5 class="mt-3 mb-0">{{$item->title}}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
												

                                                 
                                            </div>

                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            @if($projectData->action=='2')
                        {{-- Mark as completed section --}}
                            <h4 class="text-primary text-center">Mark Project as completed</h4>
                            <div class="row">
                                <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{route('user.markAsCompleted')}}" class="">
                                            @csrf
                                            <div class="container row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="">Select Date<star>*</star></label>
                                                        <input type="date" name="completed_date" class="form-control" required>
                                                        <input type="hidden" name="user_id" value="{{$contractdata->user_id}}" class="form-control" required>
                                                        <input type="hidden" name="project_id" value="{{$projectData->project_id}}" class="form-control" required>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Add remarks<star>*</star></label>
                                                        <textarea type="text" name="project_complete_remarks" class="form-control" required></textarea>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-2">
                                                    <button class="btn btn-primary my-3">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
