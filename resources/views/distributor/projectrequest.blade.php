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
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title text-white">@yield('title')</h4>
                        <p class="p-0 m-0 text-white">Total Project Request: <b>{{$projectrequest->total();}}</b>, Page No: <b>{{$projectrequest->currentPage();}}</b></p>
                        
                    </div>
                    <div class="card-body">

                        <h4 class="card-title">@yield('title')</h4>
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Beneficiary Name</th>
                                <th>Beneficiary Mobile</th>
                                <th>Alt Mobile</th>
                                <th>Full Address</th>
                                <th>Picture</th>
                                <th>Video</th>
                                 <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                @foreach ($projectrequest as $key => $data)
                                <tr>
                                    <td>{{($projectrequest->currentpage()-1) * $projectrequest->perpage() + $key + 1}}</td>
                                    <td>{{$data->beneficiray_name}}</td>
                                    <td>{{$data->beneficiary_mobile}}</td>
                                    <td>{{$data->alt_mobile_number}}</td>
                                    <td>{{$data->full_address}}</td>
                                    <td><button type="button" onclick="showDetails(this)" id="{{$data->id}}" class="btn btn-primary">View&nbsp;Image</button></td>
                                    <td><img style="max-width:120px;" src="{{asset('uploads/proposal/'.$data->proposal_photo)}}" alt="" class="img-thumbanil"></td>
                                    <td><video width='220px' height='220px' src="{{asset('uploads/proposal/'.$data->proposal_video)}}" controls></video></td>
                                     
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm">View Details</button>
                                        <button class="btn btn-danger btn-sm">Block</button>
                                    </td>
                                </tr>
                                @endforeach
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
                <h5 class="modal-title" id="myExtraLargeModalLabel">Project Request - <span id="imagereqid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="coursedetailsshow" class="modal-body">
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

</script>
@endsection
