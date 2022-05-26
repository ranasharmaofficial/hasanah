@extends('distributor.layouts.master')
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
                                <li class="breadcrumb-item"><a href="{{ url('distributor/home') }}">Dashboard</a></li>
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
                                                        $datedays = strtotime($ongoingProjects->no_of_days)-strtotime($ldate);
                                                        $datediff = (round($datedays / 86400));
                                                    @endphp
													<tr>
														<td>Contractor&nbsp;Name</td>
														<td class="text-right">{{$ongoingProjects->contractor_name}} ({{$ongoingProjects->username}})</td>
													</tr>
													<tr>
														<td>Company</td>
														<td class="text-right">{{$ongoingProjects->company_name}}</td>
													</tr>
													<tr>
														<td>Category</td>
														<td class="text-right">{{$ongoingProjects->project_category}}</td>
													</tr>
													<tr>
														<td>Project&nbsp;Name</td>
														<td class="text-right">{{$ongoingProjects->project_name}}</td>
													</tr>
													<tr>
														<td>Project&nbsp;Number</td>
														<td class="text-right">{{$ongoingProjects->project_number}}</td>
													</tr>
                                                    <tr>
														<td>Project&nbsp;Status</td>
														<td class="text-right">Ongoing</td>
													</tr>
                                                    <tr>
														<td>Project&nbsp;Amount</td>
														<td class="text-right text-primary">Rs:&nbsp;{{$ongoingProjects->amount}}/-</td>
													</tr>
                                                    <tr>
														<td>Days&nbsp;to&nbsp;Go</td>
														<td>
                                                            <p class="bg-success text-white p-1 rounded shadow"><strong>Date&nbsp;From:</strong>&nbsp;{{$ongoingProjects->created_at->format('d-m-Y')}}</p>
                                                            <p class="bg-danger text-white p-1 rounded shadow"><strong>Days to left:</strong>&nbsp;{{$datediff}}</p>
                                                        </td>
													</tr>
                                                    <form action="{{route('distributor.project-approve')}}" method="post" enctype="multipart/form-data"> 
                                                        @csrf

                                                        <input type="hidden" name="contractorid" value="{{$ongoingProjects->username}}" required />
                                                        <input type="hidden" name="projectid" value="{{$ongoingProjects->project_id}}" required />
                                                        <input type="hidden" name="companyid" value="{{$ongoingProjects->company_id}}" required />
                                                        <tr class="text-center" style="background: #DCFFF4; border: none;">
                                                            <td colspan="2" style="border: none;">
                                                                <h4 class="text-success" style="text-shadow: 1px 1px #540c8b;">Approve Project Now</h4>
                                                            </td>
                                                        </tr>
                                                        <tr style="background: #DCFFF4; border: none;">
                                                            <td style="border: none;">
                                                                <input type="tel" class="form-control" name="amount" value="{{$ongoingProjects->distribute_amount}}" required placeholder="Total Amount" readonly>
                                                                <small class="form-text text-danger">
                                                                    @error('amount')
                                                                        {{$message}}
                                                                    @enderror
                                                                </small>
                                                            </td>
                                                            <td style="border: none;">
                                                                <input type="tel" class="form-control" name="penalty_amount" required placeholder="Enter Penalty Amount">
                                                                <small class="form-text text-danger">
                                                                    @error('penalty_amount')
                                                                        {{$message}}
                                                                    @enderror
                                                                </small>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-center" style="background: #DCFFF4; border: none;">
                                                            <td style="border: none;" colspan="2"><button class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                                              </svg> Approve Now</button></td>
                                                        </tr>
                                                    </form>
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
                                            <div class="row">
                                                @foreach ($user_project_images as $item)
                                                <div class="col-xl-4 col-sm-6">
                                                    <div class="card" style="background: rgba(245, 245, 246, 0.533);" onclick="window.location.href='{{url('employee/project-image-details').'/'.$item->project_id.'/'.$item->user_id.'/'.$item->id}}'">
                                                        <img src="{{$item->image_url}}" alt="img-1" class="card-img-top" style="width: 100%; height: 18rem;">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title">{{$item->title}}</h5>
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
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
