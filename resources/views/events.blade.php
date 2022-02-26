@extends('master')

@section('title')Events - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')
<div class="pager-header">
    <div class="container">
        <div class="page-content">
            <h2>Upcoming Events</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Events</li>
            </ol>
        </div>
    </div>
</div><!-- /Page Header -->

<section class="event-section bg-grey padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
            <h2>Upcoming Events</h2>
        </div>
        <div class="event-items">
            @foreach ($events as $item)
            <div class="row event-wrap d-flex align-items-center">
                <div class="col-lg-7">
                    <div class="event-details">
                        <h2><a href="#">{{$item->eventTitle}}</a></h2>
                        <ul class="event-time">
                            <li><i class="fa fa-clock-o"></i>{{$item->created_at}}</li>
                        </ul>
                        <p>{!! html_entity_decode($item->eventDetails) !!}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="event-thumb">
                        <img src="{{asset('uploads/events').'/'.$item->eventImage}}" alt="event">
                    </div>
                </div>
            </div><!-- Event-1 -->
            @endforeach

            
        </div>
        <div class="load-more text-center mt-40">
            <a href="#" class="default-btn">More Events</a>
        </div>
    </div>
</section><!-- Event Section -->
 
@endsection