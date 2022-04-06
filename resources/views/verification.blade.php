@extends('master')

@section('title')Otp Verification - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')

<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 contact-wrap">
                <div class="contact-form">
                    <h3 class="text-center">Verify Your Mobile Number</h3>
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
                            <div class="col-sm-12">
                                <input type="text" id="otp" value="{{old('otp')}}" name="otp" class="form-control" placeholder="Verify OTP" required>
                                    <span class="form-text text-danger">@error('otp')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            
                        </div>
                        
                       <div class="form-group row">
                            <div class="col-md-12">
                                <button id="submit" style="cursor: pointer;" class="default-btn" type="submit">VERIFY</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->

@endsection