@extends('user.layouts.master')
@section('title', 'Upload Image')
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
														<td class="text-right">Ongoing</td>
													</tr>
                                                    <tr>
														<td>Project&nbsp;Amount</td>
														<td class="text-right">{{$projectData->amount}}</td>
													</tr>
                                                    <tr>
														<td>Days&nbsp;to&nbsp;Go</td>
														<td class="text-right">ditributor-name</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div> <!-- end col -->
                            <h4 class="card-title">@yield('title')</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{route('uploadUserImage')}}" enctype="multipart/form-data" method="POST" class="row">
                                @csrf
                                {{-- <div class="col-sm-6">
                                    <label for="Project" class="col-form-label">Project Title <star>*</star></label>
                                    <input type="text" class="form-control" placeholder="Enter Project Title" name="title" id="Project">
                                    <small class="form-text text-danger">@error('title') {{ $message }} @enderror</small>
                                </div> --}}
                                    @if (isset($_GET['user_id']))
                                    <input type="hidden" name="user_id" value="{{$_GET['user_id']}}" id="">
                                    <input type="hidden" name="project_id" value="{{$_GET['project_id']}}" id="">
                                    <input type="hidden" name="distributor_id" value="{{$_GET['distributor_id']}}" id="">
                                    @endif
                                {{-- <div class="col-sm-6">
                                    <label for="Image" class="col-form-label">Project Image <star>*</star></label>
                                    <input type="file" class="form-control" name="file" id="Image">
                                    <small class="form-text text-danger">@error('file') {{ $message }} @enderror</small>
                                </div> --}}
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Project Title <star>*</star></th>
                                        <th>Project Image <star>*</star></th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td><input type="text" name="project[0][project_title]" placeholder="Enter Project Title" class="form-control"  /></td>
                                        <td><input type="file" name="project[0][project_image]" placeholder="Choose Project Image" class="form-control"  /></td>
                                        <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add More</button></td>
                                    </tr>
                                </table>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    // let sl = 1;
    $("#dynamic-ar").click(function () {
        ++i;
        // sl++;
        $("#dynamicAddRemove").append('<tr><td>'+ i +'</td><td><input type="text" name="project[' + i +
            '][project_title]" placeholder="Enter subject" class="form-control"  /></td><td><input type="file" name="project[' + i +
            '][project_image]" placeholder="Choose Project Image" class="form-control"  /> </td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection
