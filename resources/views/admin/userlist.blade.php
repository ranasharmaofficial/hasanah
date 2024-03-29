@extends('admin.layouts.master')
@section('title','Contractor List')
@section('content')
<style>
table.border-modal{
    border:1px solid blue;
    margin-top:20px;
  }
table.border-modal > thead > tr > th{
    border:1px solid rgb(156, 231, 206);
}
table.border-modal > tbody > tr > th{
    border:1px solid rgb(156, 231, 206);
}
table.border-modal > tbody > tr > td{
    border:1px solid rgb(156, 231, 206);
}
</style>
 <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">@yield('title')</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Dashboard</a></li>
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
                    <div class="card-header bg-danger rounded">
                        <h3 class="card-title text-white">@yield('title')</h3>
                        <p class="p-0 m-0 text-white">Total Contractor: <b>{{$contractors->total();}}</b>, Page No: <b>{{$contractors->currentPage();}}</b></p>
                    </div>
                    <div class="card-body table-responsive"> 
                        <form method="get" style="float: right;">
                            <div class="app-search">
                                <input name="search" value="{{$sort_search}}" type="text" class="form-control" placeholder="Search here...">
                                <span id="search_icons" class="ri-search-line"></span>
                            </div>
                        </form>	                       
                        <table  id="datatable"  class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th>Sl. No.</th>
                                <th>User ID</th>
                                <th>Password</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Company Name</th>
                                <th>Joining Date</th>
                                <th>Ongoing Project</th>
                                <th>Completed Project</th>
                                <th>Total Project</th>
                                <th>Total Amount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Total Penalty</th>
                                <th>Score</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contractors as $key => $data)
                            <tr>
                                <td>{{($contractors->currentpage()-1) * $contractors->perpage() + $key + 1}}</td>
                                <td>{{$data->user_id}}</td>
                                <td>{{$data->password}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->mobile}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{ $data->companyName }}</td>
                                <td>{{$data->created_at->format('d-m-Y')}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                                <td class="text-center">
                                    {{-- @if ($data->status == 0)
                                    <form action="{{route('unBlockUserContract')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i>&nbsp;Un-Block</button>
                                    </form>
                                    @else
                                    <form action="{{route('blockUserContract')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i>&nbsp;Block</button>
                                    </form>
                                    @endif
                                   <hr> --}}
                                   
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupVerticalDrop1" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <hr>
                                            <a class="dropdown-item" href="#">Delete</a>
                                            <hr>
                                            @if ($data->status == 0)
                                            <form action="{{route('unBlockUserContract')}}" method="POST" class="d-inline dropdown-item">
                                                @csrf
                                                <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                                <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i>&nbsp;Un-Block</button>
                                            </form>
                                            @else
                                            <form action="{{route('blockUserContract')}}" method="POST" class="d-inline dropdown-item">
                                                @csrf
                                                <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                                <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i>&nbsp;Block</button>
                                            </form>
                                            @endif
                                            <hr>
                                            <button type="button" class="btn btn-info d-inline dropdown-item" title="View Details" onclick="showDetails(this)" id="{{$data->user_id}}"><i class="fa fa-eye"></i></button>
                                            <hr>
                                        </div>
                                    </div>
                                 
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{$contractors->links();}}
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
<div class="modal fade bs-example-modal-lg" id="userDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #ECF8FE;">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="myExtraLargeModalLabel">Supervisor Details - (User ID: <span id="userid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userdetailsshow">
                <table class="table table-bordered border-modal">
                    <tr>
                        <th>Contractor ID:</th>
                        <td id="concontractid"></td>
                    </tr>
                    <tr>
                        <th>Aadhar Number:</th>
                        <td id="conaadharnumber"></td>
                    </tr>
                    <tr>
                        <th>Pan Number:</th>
                        <td id="conpannumber"></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><span id="conlandmark"></span>, <span id="concity"></span>, <span id="constate"></span>, <span id="concountry"></span>, <span id="conpincode"></span></td>
                    </tr>
                    <tr>
                        <th>Alternate Mobile Number:</th>
                        <td id="conaltmobile"></td>
                    </tr>
                    <tr>
                        <th>Photo:</th>
                        <td id="conphoto"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <form action="{{route('disApproveContractor')}}" method="post" class="d-inline">
                    @csrf
                    <input type="hidden" value="" name="userid" id="userContractID" required />
                    <button type="submit" class="btn btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;Dis-Approve</button>
                </form>
                <form action="{{route('approveContractor')}}" method="post" class="d-inline">
                    @csrf
                    <input type="hidden" value="" name="userid" id="userContractIDa" required />
                    <button type="submit" class="btn btn-primary"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;Approve</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    function showDetails(showdetails){
        $('#userDetails').modal('show'); 
        let user_id = $(showdetails).attr('id');
        $('#userid').html(user_id);
        $.ajax({
            url: '{{url('getuserdetails')}}',
            type: 'post',
            data:'userid='+user_id+'&_token={{csrf_token()}}',
            success:function(respons){
                $('#concontractid').html(JSON.parse(respons)[0].contractorID);
                $('#conaadharnumber').html(JSON.parse(respons)[0].aadharNumber);
                $('#conpannumber').html(JSON.parse(respons)[0].panNumber);
                $('#conlandmark').html(JSON.parse(respons)[0].landmark);
                $('#concity').html(JSON.parse(respons)[0].city);
                $('#constate').html(JSON.parse(respons)[0].state);
                $('#concountry').html(JSON.parse(respons)[0].country);
                $('#conpincode').html(JSON.parse(respons)[0].pincode);
                $('#conaltmobile').html(JSON.parse(respons)[0].altMobile);
                $('#conphoto').html(JSON.parse(respons)[0].photo);
                $('#userContractID').val(JSON.parse(respons)[0].user_id);
                $('#userContractIDa').val(JSON.parse(respons)[0].user_id);
                // console.log(JSON.parse(respons)[0].contractorID);
            }
        })
    }

</script>
@endsection
