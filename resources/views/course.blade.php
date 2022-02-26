@extends('master')

@section('title')Our Course - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')
<style>
.card-img-top{
    /* width: 345px; */
    height: 207px;
}
.card{
    cursor: pointer;
}
</style>
<div class="pager-header">
    <div class="container">
        <div class="page-content">
            <h2>Our Courses</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Courses</li>
            </ol>
        </div>
    </div>
</div><!-- /Page Header -->

<section class="course-section bg-grey padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
           <h2>Popular Courses</h2>
         </div>
        <div class="col-sm-12">
            <div class="row">
                @foreach ($courses as $course)
                <div class="card col-lg-3 p-0 m-1" onclick="window.location.href='{{url('course-details').'/'.$course->slug}}'">
                    <div class="card-body p-0">
                        <img src="{{asset('uploads/courses').'/'.$course->courseImage}}" class="card-img-top" alt="{{$course->courseName}}">
                    </div>
                    <div class="card-footer">
                        <h3 class="text-center"><a href="{{url('course-details').'/'.$course->slug}}">{{$course->courseName}}</a></h3>
                    </div>
                </div> 
                <div class="card col-lg-3 p-0 m-1" onclick="window.location.href='{{url('course-details').'/'.$course->slug}}'">
                    <div class="card-body p-0">
                        <img src="{{asset('uploads/courses').'/'.$course->courseImage}}" class="card-img-top" alt="{{$course->courseName}}">
                    </div>
                    <div class="card-footer">
                        <h3 class="text-center"><a href="{{url('course-details').'/'.$course->slug}}">{{$course->courseName}}</a></h3>
                    </div>
                </div> 
                <div class="card col-lg-3 p-0 m-1" onclick="window.location.href='{{url('course-details').'/'.$course->slug}}'">
                    <div class="card-body p-0">
                        <img src="{{asset('uploads/courses').'/'.$course->courseImage}}" class="card-img-top" alt="{{$course->courseName}}">
                    </div>
                    <div class="card-footer">
                        <h3 class="text-center"><a href="{{url('course-details').'/'.$course->slug}}">{{$course->courseName}}</a></h3>
                    </div>
                </div> 
                @endforeach                
            </div>
        </div>              
    </div>
</section><!-- /#Course-Section -->
@endsection