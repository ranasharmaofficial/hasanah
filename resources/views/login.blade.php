@extends('master')

@section('title')Login - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')
<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center mb-5 mt-5">
            <div class="card col-md-6 mt-3">
                <div class="contact-form card-body">
                    <h3 class="text-center m-0 p-0 text-danger">Login to your Account</h3>
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
                    <form action="{{route('studentLogin')}}" method="post" class="form-horizontal">
                        @csrf
                        <div class="colum-row row">
                            <div class="col-sm-12 form-group">
                                <input type="text" onkeyup="var start = this.selectionStart;var end = this.selectionEnd;this.value = this.value.toUpperCase();this.setSelectionRange(start, end);" id="username" value="{{old('username')}}" name="username" class="form-control" placeholder="Username" required>
                                    <span class="form-text text-danger">@error('username')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12 form-group">
                                <input type="password" id="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Password" required>
                                    <span class="form-text text-danger">@error('password')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                            <div class="col-sm-12 form-group text-center">
                                <button id="submit" style="cursor: pointer;" class="default-btn rounded" type="submit">LOGIN</button>
                            </div>
                           
                     </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->

@endsection