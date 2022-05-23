@extends('employee.layouts.master')
@section('title', 'OnGoing Project Details Image Details')
@section('content')
<style>
    ul li{
        list-style-type: none;
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
														<td class="text-right">Ongoing</td>
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
                            <h4 class="text-primary text-center">Give review on image</h4>
                            <div class="row">
                                <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card" style="background: rgba(245, 245, 246, 0.533);" >
                                                        <img src="{{$user_project_images->image_url}}" alt="img-1" class="card-img-top">
                                                        <div class="card-body">
                                                            <h5>{{$user_project_images->title}}</h5>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <form action="{{route('employee.upload-comment')}}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="projectid" required value="{{$user_project_images->project_id}}">
                                                                        <input type="hidden" name="contractorid" required value="{{$user_project_images->user_id}}">
                                                                        <input type="hidden" name="imageid" required value="{{$user_project_images->id}}">
                                                                        <div class="form-group col-sm-12">
                                                                            <label for="comment" class="form-label text-left">Enter your comment</label>
                                                                            <textarea class="form-control" name="comment" id="comment" required placeholder="Enter your comment"></textarea>                                      
                                                                            <small class="form-text text-danger">@error('comment') {{ $message }} @enderror</small>                                      
                                                                        </div>
                                                                        <div class="form-group col-sm-12 text-center">
                                                                            <button class="btn btn-primary mt-3"><i class="fa fa-paper-plane"></i> Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    <div class="col-sm-12 mt-3">
                                                                        <ul>
                                                                            @forelse ($comments as $comment)
                                                                            <li class="mb-2">
                                                                                <p style="font-size: 1rem; margin: 0;">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="navy" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                                                                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                                                                    </svg>&nbsp;{{$comment->comment}}
                                                                                </p>
                                                                                <p class="text-danger">
                                                                                    Posted date: {{$comment->created_at}}
                                                                                </p>
                                                                            </li>
                                                                            @empty
                                                                                <li class="text-danger">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-right" viewBox="0 0 16 16">
                                                                                        <path fill-rule="evenodd" d="M14.854 4.854a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 4H3.5A2.5 2.5 0 0 0 1 6.5v8a.5.5 0 0 0 1 0v-8A1.5 1.5 0 0 1 3.5 5h9.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4z"/>
                                                                                    </svg>&nbsp;Oohoo! Please give review on this picture.
                                                                                </li>
                                                                            @endforelse
                                                                            
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
