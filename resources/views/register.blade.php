@extends('master')

@section('title')Register - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')

<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 contact-wrap">
                <div class="contact-form">
                    <h3 class="text-center">Register your Account</h3>
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
                                <input type="text" id="name" value="{{old('name')}}" name="name" class="form-control" placeholder="Name" required>
                                    <span class="form-text text-danger">@error('name')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12">
                                <input type="tel" id="mobile" value="{{old('mobile')}}" name="mobile" class="form-control" placeholder="Mobile" required>
                                    <span class="form-text text-danger">@error('mobile')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12">
                                <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email"
                                    required>
                                    <span class="form-text text-danger">@error('email')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12">
                                <input type="password" id="password" value="{{old('email')}}" name="email" class="form-control" placeholder="Password"
                                    required>
                                    <span class="form-text text-danger">@error('password')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12">
                                <input type="password" id="password" value="{{old('email')}}" name="email" class="form-control" placeholder="Confirm Password" required>
                                    <span class="form-text text-danger">@error('password')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        
                       <div class="form-group row">
                            <div class="col-md-12">
                                <button id="submit" style="cursor: pointer;" class="default-btn" type="submit">REGISTER</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->

@endsection