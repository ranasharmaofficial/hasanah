@extends('user.layouts.master')
@section('title', 'Upload Video')
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
                        <div class="card-body">
							<div class="row">
								<div class="col-sm-8">
									<div class="container">
										<div class="row mb-3">
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td>Project Title</td>
														<td class="text-right">project-title</td>
													</tr>
													<tr>
														<td>Project Id</td>
														<td class="text-right">Project id</td>
													</tr>
													<tr>
														<td>Project Amount</td>
														<td class="text-right">project-amount</td>
													</tr>
													<tr>
														<td>Distributor</td>
														<td class="text-right">ditributor-name</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div> <!-- end col -->
                            <h4 class="card-title">@yield('title')</h4>
                            <form action="" method="POST" class="row">
                                @csrf
                                <div class="col-sm-6">
                                    <label for="Project" class="col-form-label">Project Title <star>*</star></label>
                                    <input type="text" class="form-control" placeholder="Enter Project Title" name="project_title" id="Project" required>
                                    <small class="form-text text-danger">@error('project_title') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="video" class="col-form-label">Project Video <star>*</star></label>
                                    <input type="file" multiple class="form-control" name="project_video" id="video" required>
                                    <small class="form-text text-danger">@error('project_video') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="submit" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
