@extends('distributor.layouts.master')
@section('title','Project Request List')
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
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white">@yield('title')</h4>
                        <p class="p-0 m-0 text-white">Total Project Request: <b>{{$projectrequest->total();}}</b>, Page No: <b>{{$projectrequest->currentPage();}}</b></p>
                        
                    </div>
                    <div class="card-body">

                        <h4 class="card-title">@yield('title')</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-dark">
                                <tr>
                                    <th>Sl.&nbsp;No.</th>
                                    <th>User&nbsp;Name</th>
                                    <th>Project&nbsp;Category</th>
                                    <th>Beneficiary&nbsp;Name</th>
                                    <th>Beneficiary&nbsp;Mobile</th>
                                    <th>Alt&nbsp;Mobile</th>
                                    <th>Full&nbsp;Address</th>
                                    <th>Picture</th>
                                    <th>Video</th>
                                     <th>Created&nbsp;At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
    
    
                                <tbody>
                                    @forelse ($projectrequest as $key => $data)
                                    <tr>
                                        <td>{{($projectrequest->currentpage()-1) * $projectrequest->perpage() + $key + 1}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->project_category}}</td>
                                        <td>{{$data->BeneficiaryName}}</td>
                                        <td>{{$data->BeneficiaryMobileNumber}}</td>
                                        <td>{{$data->AltMobile}}</td>
                                        <td>{{$data->FullAddress}}</td>
                                        <td><button type="button" onclick="showDetails(this)" id="{{$data->projectRequestId}}" class="btn btn-primary btn-sm">View&nbsp;Image</button></td>
                                        <td><button type="button" onclick="showVideo(this)" id="{{$data->projectRequestId}}" class="btn btn-success btn-sm">Play&nbsp;Video</button></td>
                                        <td>{{$data->created_at}}</td>
                                        <td>
                                            <form action="{{route('distributor/project-request-details')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="project_req_id" value="{{$data->projectRequestId}}">
                                                <button class="btn btn-success btn-sm">View&nbsp;Details</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-danger text-center">Data Not Available</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="7">
                                            <nav aria-label="...">
                                                <ul class="pagination justify-content-end mb-0">
                                                    {{$projectrequest->links();}}
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>
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
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="imagedetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Project Request: Proposal Image - <span id="imagereqid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="coursedetailsshow" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" id="videodetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Project Request: Proposal Video- <span id="videoreqid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="videodetailsshow" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function showDetails(showdetails){
        $('#imagedetails').modal('show'); 
		let datas = '';
        let imagereqid = $(showdetails).attr('id');
        $('#imagereqid').html(imagereqid);
        $.ajax({
            url: '{{url('getImageDetails')}}',
            type: 'post',
            data:'imagereqid='+imagereqid+'&_token={{csrf_token()}}',
            success:function(respons){                
				console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/proposal")}}/'+respons+'" alt="Proposal Image">';
                }
				$('#coursedetailsshow').html(datas);
			}
        })
    }
    
    function showVideo(showvideo){
        $('#videodetails').modal('show'); 
		let datas = '';
        let videoreqid = $(showvideo).attr('id');
        $('#videoreqid').html(videoreqid);
        $.ajax({
            url: '{{url('getVideoDetails')}}',
            type: 'post',
            data:'videoreqid='+videoreqid+'&_token={{csrf_token()}}',
            success:function(respons){                
				console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Video not found</div>';
                }
                else{
                    datas += '<video class="img-fluid" src="{{asset("uploads/proposal")}}/'+respons+'" controls></video>';
                }
				//console.log(datas);
				$('#videodetailsshow').html(datas);
			}
        })
    }

</script>
@endsection
