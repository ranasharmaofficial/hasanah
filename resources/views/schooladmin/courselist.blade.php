@extends('admin.layouts.master')
@section('title','Course List')
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
                        <h4 class="card-title">@yield('title')</h4>
                        <p class="p-0 m-0">Total Courses: <b>{{$courselists->total();}}</b>, Page No: <b>{{$courselists->currentPage();}}</b></p>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Course&nbsp;Name</th>
                                    <th>Course&nbsp;Title</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($courselists as $key => $courselist)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$courselist->courseName}}</td>
                                    <td>{{$courselist->courseTitle}}</td>
                                    <td>{{$courselist->slug}}</td>
                                    <td>{{$courselist->created_at}}</td>
                                    <td>
                                        @if ($courselist->updated_at !== null)
                                        {{$courselist->updated_at}}
                                        @else 
                                        Null
                                        @endif
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" onclick="showDetails(this)" id="{{$courselist->course_id}}">Course&nbsp;Details</button></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end">
                                {{$courselists->links();}}
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
<div class="modal fade bs-example-modal-xl" id="courseDetails" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Course Details - (Course ID: <span id="courseid"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="coursedetailsshow">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function showDetails(showdetails){
        $('#courseDetails').modal('show'); 
        let course_id = $(showdetails).attr('id');
        $('#courseid').html(course_id);
        $.ajax({
            url: '{{url('getcoursedetails')}}',
            type: 'post',
            data:'courseid='+course_id+'&_token={{csrf_token()}}',
            success:function(respons){
                $('#coursedetailsshow').html(respons);
            }
        })
    }

</script>
@endsection
