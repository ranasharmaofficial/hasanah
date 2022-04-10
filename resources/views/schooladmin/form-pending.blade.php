@extends('schooladmin.layouts.master')
@section('title','Student Entrance Exam Pending Form')
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
                            <li class="breadcrumb-item"><a href="{{url('schooladmin/home')}}">Dashboard</a></li>
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
                        <p class="p-0 m-0 text-white">Total Pending Form: <b>{{$studentformlists->total();}}</b>, Page No: <b>{{$studentformlists->currentPage();}}</b></p>
                    </div>
                    <div class="card-body table-responsive">                        
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl.&nbsp;No.</th>
                                <th>Form ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Student Photo</th>
                                <th>Documents</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($studentformlists as $key => $data)
                            <tr>
                                <td>{{($studentformlists->currentpage()-1) * $studentformlists->perpage() + $key + 1}}</td>
                                <td>{{$data->form_id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->mobile}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->city}}, {{$data->state}}, {{$data->country}}, {{$data->pincode}}</td>
                                <td><img src="{{asset('uploads/student-documents').'/'.$data->passport_photo}}" alt="{{$data->name}}" class="img-thumbnail" ></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm m-1" onclick="showAadharCard(this)" id="{{$data->form_id}}">Aadhar Card</button>
                                    <button type="button" class="btn btn-primary btn-sm m-1" onclick="showFatherAadharCard(this)" id="{{$data->form_id}}">Father Aadhar Card</button>
                                    <button type="button" class="btn btn-primary btn-sm m-1" onclick="showMarkSheet(this)" id="{{$data->form_id}}">Last Year Exam Marksheet</button>
                                </td>
                                <td>{{$data->created_at->format('d-m-Y')}}</td>
                                <td>
                                    <form action="{{route('entranceApprove')}}" method="post" class="m-1">
                                        @csrf
                                        <input type="hidden" name="form_id" value="{{$data->form_id}}" required />
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-thumbs-up">&nbsp;Approve</i></button>
                                    </form>
                                    <form action="{{route('entranceRejected')}}" method="post" class="m-1">
                                        @csrf
                                        <input type="hidden" name="form_id" value="{{$data->form_id}}" required />
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down">&nbsp;Reject</i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger">Data not available</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="7">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{$studentformlists->links();}}
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

<!--  Aadhar Card Photo Image Start -->
<div class="modal fade bs-example-modal-lg" id="aadharCard" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Aadhar Card Photo - <span id="studentid"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="aadharcarddetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Aadhar card Image Start-->

<!--  Father Aadhar card Image Start -->
<div class="modal fade bs-example-modal-lg" id="fatheraadharCard" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Father's Aadhar Card Photo - <span id="studentid1"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="fatheraadharcarddetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Father aadhar card Image Start-->

<!--  Mark sheet card Image Start -->
<div class="modal fade bs-example-modal-lg" id="marksheet" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Last Year Exam Marksheet - <span id="studentid2"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="marksheetdetails" class="modal-body">
                {{-- <img id="coursedetailsshow" style="max-width:120px;" src="" alt="" class="img-thumbanil"> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Mark sheet card Image Start-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
    function showAadharCard(showAadharCard){
        $('#aadharCard').modal('show'); 
		let datas = '';
        let studentid = $(showAadharCard).attr('id');
        $('#studentid').html(studentid);
        $.ajax({
            url: '{{url('getAadharCard')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				// console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#aadharcarddetails').html(datas);
			}
        })
    }
    
    function showFatherAadharCard(showFatherAadharCard){
        $('#fatheraadharCard').modal('show'); 
		let datas = '';
        let studentid = $(showFatherAadharCard).attr('id');
        $('#studentid1').html(studentid);
        $.ajax({
            url: '{{url('getFatherAadharCard')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				// console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#fatheraadharcarddetails').html(datas);
			}
        })
    }

    function showMarkSheet(showMarkSheet){
        $('#marksheet').modal('show'); 
		let datas = '';
        let studentid = $(showMarkSheet).attr('id');
        $('#studentid2').html(studentid);
        $.ajax({
            url: '{{url('getMarkSheet')}}',
            type: 'post',
            data:'studentid='+studentid+'&_token={{csrf_token()}}',
            success:function(respons){                
				// console.log(respons);
                if(respons == '')
                {
                    datas += '<div class="alert alert-danger">Image not found</div>';
                }
                else{
                    datas += '<img class="img-fluid" src="{{asset("uploads/student-documents")}}/'+respons+'" alt="Passport Photo">';
                }
				$('#marksheetdetails').html(datas);
			}
        })
    }
    </script>

@endsection
