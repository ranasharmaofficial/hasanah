@extends('master')

@section('title')Login - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')

<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 contact-wrap">
                <div class="contact-form">
                    <h3 class="text-center">Login</h3>
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
                                <input type="text" id="username" value="{{old('username')}}" name="username" class="form-control" placeholder="Username" required>
                                    <span class="form-text text-danger">@error('username')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" id="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Password" required>
                                    <span class="form-text text-danger">@error('password')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            
                        </div>
                       <div class="form-group row">
                            <div class="col-md-12">
                                <button id="submit" style="cursor: pointer;" class="default-btn" type="submit">LOGIN</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->

@endsection