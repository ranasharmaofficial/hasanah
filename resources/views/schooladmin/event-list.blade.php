@extends('admin.layouts.master')
@section('title','Events List')
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
                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0">Total Events: <b>{{$eventlists->total();}}</b>, Page No: <b>{{$eventlists->currentPage();}}</b></p>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Event&nbsp;Name</th>
                                    <th>Event&nbsp;Title</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($eventlists as $key => $eventlist)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$eventlist->eventName}}</td>
                                    <td>{{$eventlist->eventTitle}}</td>
                                    <td>{{$eventlist->slug}}</td>
                                    <td>{{$eventlist->created_at}}</td>
                                    <td>
                                        @if ($eventlist->updated_at !== null)
                                        {{$eventlist->updated_at}}
                                        @else 
                                        Null
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="showDetails(this)" id="{{$eventlist->eventID}}">Event&nbsp;Details</button>
                                        <form action="{{route('deleteEvent')}}" method="post" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" value="{{$eventlist->eventID}}" name="eventid" required />
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
                                {{$eventlists->links();}}
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
<div class="modal fade bs-example-modal-xl" id="eventDetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Event Details - (Event ID: <span id="eventid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="eventdetailsshow">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function showDetails(showdetails){
        $('#eventDetails').modal('show'); 
        let eventid = $(showdetails).attr('id');
        $('#eventid').html(eventid);
        $.ajax({
            url: '{{url('geteventdetails')}}',
            type: 'post',
            data:'eventid='+eventid+'&_token={{csrf_token()}}',
            success:function(respons){
                $('#eventdetailsshow').html(respons);
            }
        })
    }

</script>
@endsection
