@extends('user.layouts.master')
@section('title','Project Request List')
@section('content')
 <div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 img_com">
                            <img src="{{asset('uploads/company-logo/'.$companydata->logo)}}" alt="" class="img-thumbnail imagefix">
                        </div>
                        <div class="col-sm-8">
                            <h4 class="dist_companyname text-primary">{{$companydata->company_name}}</h4>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title align-items-right text-right">
                        <h4 class="text-right">Designation :<span class="text-primary"> Contractor</span></h4>
                        <h4 class="">Last Login at :<span class="text-primary"> {{$lastLoginTime->created_at}}</span></h4>
                        <h4 class="mt-1">Name : <span class="text-primary"> {{ $LoggedContractInfo['name'] }}</span</h4>
                        <h4 class="mt-1">User Id :<span class="text-primary">  {{ $LoggedContractInfo['user_id'] }}</span</h4>
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
                    </div>
                    <div class="card-body">
                       
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-dark">
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Beneficiary Name</th>
                                    <th>Beneficiary Mobile</th>
                                    <th>Address</th>
                                    <th>Photo</th>
                                    <th>Video</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($projectrequest as $key => $data)
                                @php
                                    $ldate = date('Y-m-d');
                                    $datedays = strtotime($data->no_of_days)-strtotime($ldate);
                                    $datediff = (round($datedays / 86400));
                                @endphp
                                <tr>
                                    <td>{{($projectrequest->currentpage()-1) * $projectrequest->perpage() + $key + 1}}</td>
                                    <td>{{$data->beneficiray_name}}</td>
                                    <td>{{$data->beneficiary_mobile}}</td>
                                    <td>{{$data->full_address}}</td>
                                    <td><button type="button" onclick="showDetails(this)" id="{{$data->id}}" class="btn btn-primary btn-sm">View&nbsp;Image</button></td>
                                        <td><button type="button" onclick="showVideo(this)" id="{{$data->id}}" class="btn btn-success btn-sm">Play&nbsp;Video</button></td>
                                    <td>
                                        @if ($data->is_asigned=='1')
                                            <span class="text-danger">In Review</span>
                                        @else 
                                            <span class="text-success">Assigned</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">Project Not Available</td>
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
            <div class="c-preloader text-center p-3">
                <i style="color:green;" class="fa fa-spinner fa-3x"></i>
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
            <div class="c-preloader text-center p-3">
                <i style="color:green;" class="fa fa-spinner fa-3x"></i>
            </div>
            <div id="videodetailsshow" class="modal-body">
                
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function showDetails(showdetails){
        $('.c-preloader').show();
        $('#coursedetailsshow').html(null);
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
                $('.c-preloader').hide();
			}
        })
    }
    
    function showVideo(showvideo){
        $('.c-preloader').show();
        $('#videodetailsshow').html(null);
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
                $('.c-preloader').hide();
			}
        })
    }

</script>
@endsection
