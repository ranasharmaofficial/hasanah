@extends('schoolemployee.layouts.master')
@section('title','Notice List')
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
                            <li class="breadcrumb-item"><a href="{{url('schoolemployee/home')}}">Dashboard</a></li>
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
                    <div class="card-body">
                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0">Total Notice: <b>{{$noticelists->total();}}</b>, Page No: <b>{{$noticelists->currentPage();}}</b></p>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Notice&nbsp;Name</th>
                                    <th>Notice&nbsp;Title</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($noticelists as $key => $noticelist)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$noticelist->noticeName}}</td>
                                    <td>{{$noticelist->noticeTitle}}</td>
                                    <td>{{$noticelist->slug}}</td>
                                    <td>{{$noticelist->created_at}}</td>
                                    <td>
                                        @if ($noticelist->updated_at !== null)
                                        {{$noticelist->updated_at}}
                                        @else 
                                        Null
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="showDetails(this)" id="{{$noticelist->noticeID}}">Notice&nbsp;Details</button>
                                        <form action="{{route('schoolemployee.deleteNotice')}}" method="post" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" value="{{$noticelist->noticeID}}" name="noticeid" required />
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                                {{$noticelists->links();}}
                            </ul>                                
                        </nav>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-xl" id="noticeDetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Notice Details - (Notice ID: <span id="noticeid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticedetailsshow">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function showDetails(showdetails){
        $('#noticeDetails').modal('show'); 
        let noticeid = $(showdetails).attr('id');
        $('#noticeid').html(noticeid);
        $.ajax({
            url: '{{url('getnoticedetails')}}',
            type: 'post',
            data:'noticeid='+noticeid+'&_token={{csrf_token()}}',
            success:function(respons){
                $('#noticedetailsshow').html(respons);
            }
        })
    }

</script>
@endsection
