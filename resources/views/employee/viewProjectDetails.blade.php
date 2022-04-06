@extends('employee.layouts.master')
@section('title', 'OnGoing Project Details')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">@yield('title')</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('employee/home') }}">Dashboard</a></li>
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
                                                    @php
                                                        $ldate = date('Y-m-d');
                                                        $datedays = strtotime($projectData->no_of_days)-strtotime($ldate);
                                                        $datediff = (round($datedays / 86400));
                                                    @endphp
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
														<td class="text-right">Ongoinf</td>
													</tr>
                                                    <tr>
														<td>Project&nbsp;Amount</td>
														<td class="text-right">{{$projectData->amount}}</td>
													</tr>
                                                    <tr>
														<td>Days&nbsp;to&nbsp;Go</td>
														<td>
                                                            <p class="bg-success text-white p-1 rounded shadow"><strong>Date&nbsp;From:</strong>&nbsp;{{$projectData->created_at->format('d-m-Y')}}</p>
                                                            <p class="bg-danger text-white p-1 rounded shadow"><strong>Days to left:</strong>&nbsp;{{$datediff}}</p>
                                                        </td>
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

                                            {{-- <div class="row mt-4">
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="mb-sm-0 mt-2">Page <span class="fw-bold">2</span> Of <span class="fw-bold">113</span></p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="float-sm-end">
                                                        <ul class="pagination pagination-rounded mb-sm-0">
                                                            <li class="page-item disabled">
                                                                <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="#" class="page-link">1</a>
                                                            </li>
                                                            <li class="page-item active">
                                                                <a href="#" class="page-link">2</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="#" class="page-link">3</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="#" class="page-link">4</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="#" class="page-link">5</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="#" class="page-link"><i class="mdi mdi-chevron-end"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
