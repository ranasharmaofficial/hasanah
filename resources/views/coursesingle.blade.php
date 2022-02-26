@extends('master')
@foreach ($coursedetails as $coursedetail)
@section('title'){{$coursedetail->courseTitle}} -  @endsection

@section('description'){{$coursedetail->courseTitle}} Hasanah Girls College @endsection

@section('content')
<div class="pager-header">
    <div class="container">
        <div class="page-content">
            <h2>{{$coursedetail->courseTitle}}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Course Details</li>
            </ol>
        </div>
    </div>
</div><!-- /Page Header -->

<section class="course-single padding">
    <div class="container">
        <div class="row course-single-wrap">
            <div class="col-md-12 col-sm-12 xs-padding">
                {{-- <div class="course-single-thumb">
                    <img src="{{asset('uploads/courses').'/'.$coursedetail->courseImage}}" alt="img">
                </div> --}}
                <div class="course-single-details">
                    <div class="course-text mt-40">
                        <h2>Course Details</h2>
                        {!! html_entity_decode($coursedetail->courseDetails) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Course Single -->



@endsection
@endforeach