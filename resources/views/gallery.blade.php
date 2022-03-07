@extends('master')

@section('title')Gallery - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection
@section('content')
<div class="pager-header">
    <div class="container">
        <div class="page-content">
            <h2>Image Gallery</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Gallery</li>
            </ol>
        </div>
    </div>
</div><!-- /Page Header -->

<section class="gallery-section bg-grey padding">
    <div class="container">
       
        <div class="gallery-items row">
            @foreach ($galleries as $item)
             <div class="col-lg-4 col-sm-6 single-item branding design">
                <div class="gallery-wrap">
                    <img src="{{asset('uploads/gallery').'/'.$item->galleryImage}}" alt="{{$item->galleryTitle}}">
                    <div class="hover">
                        <a class="img-popup" data-gall="galleryimg" href="{{asset('uploads/gallery').'/'.$item->galleryImage}}"><i
                                class="ti-image"></i></a>
                    </div>
                </div>
            </div><!-- /Item-1 -->
            @endforeach
            
            
        </div>
    </div>
</section><!-- /Gallery Section -->


@endsection