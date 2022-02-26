@extends('master')

@section('title')Contact Us - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')
<div class="pager-header">
    <div class="container">
        <div class="page-content">
            <h2>Contact With Us</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </div>
    </div>
</div><!-- /Page Header -->

<section class="contact-section padding">
    <div id="google_map"></div><!-- /#google_map -->
    <div class="container">
        <div class="row contact-wrap">
            <div class="col-md-6 xs-padding">
                <div class="contact-info">
                    <h3>Get in touch</h3>
                    <p>If you have any questions simply use the following contact details.</p>
                    <ul>
                        <li><i class="ti-location-pin"></i> Araria, Bihar, India</li>
                        <li><i class="ti-mobile"></i> +91 09931481362, +91 08678801677, +91 09973674857</li>
                        <li><i class="ti-email"></i> hasanah.india@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 xs-padding">
                <div class="contact-form">
                    <h3>Drop us your Message</h3>
                    <p>&nbsp;</p>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <form action="{{route('enquiryContact')}}" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" id="name" value="{{old('name')}}" name="name" class="form-control" placeholder="Name"
                                    required>
                                    <span class="form-text text-danger">@error('name')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-6">
                                <input type="tel" id="mobile" value="{{old('mobile')}}" name="mobile" class="form-control" placeholder="Mobile"
                                    required>
                                    <span class="form-text text-danger">@error('mobile')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="form-group colum-row row">
                            <div class="col-sm-12">
                                <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email"
                                    required>
                                    <span class="form-text text-danger">@error('email')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="message" name="message" cols="30" rows="5" class="form-control message"
                                    placeholder="Message" required>value="{{old('message')}}"</textarea>
                                    <span class="form-text text-danger">@error('message')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button id="submit" style="cursor: pointer;" class="default-btn" type="submit">Send Message</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->

@endsection