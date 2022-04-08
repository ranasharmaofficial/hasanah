@extends('admin.layouts.master')
@section('title','Update Contact')
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
        
        <div class="card">
            <div class="card-body">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if (Session::has('alert-' . $msg))
                            <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                {{ Session::get('alert-' . $msg) }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if ($contact)
                <form method="post" action="{{route('updateContactDetailsU')}}" class="row" enctype="multipart/form-data">
                    @csrf	
                    <input type="hidden" value="{{$contact->contact_id}}" name="contactid" required>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="Mobile">Mobile Number <star>*</star></label>
                            <input  class="form-control" placeholder="Your Mobile No. here" id="Mobile" type="text" value="{{$contact->mobile}}" name="mobile"/>
                            <small class="text-danger form-text"> @error('mobile') {{$message}} @enderror </small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="Mobile">Alt. Mobile Number</label>
                            <input  class="form-control" placeholder="Your Alt. Mobile here" id="Mobile" type="text" value="{{$contact->altMobile}}" name="altmobile"/>
                            <small class="text-danger form-text"> @error('altmobile') {{$message}} @enderror </small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="Email">Email <star>*</star></label>
                            <input placeholder="Your Email here" class="form-control" id="Email" type="email" value="{{$contact->email}}" name="email"/>
                            <small class="text-danger form-text"> @error('email') {{$message}} @enderror </small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="address">Address <star>*</star></label>
                            <textarea  placeholder="Your full address here" class="form-control" id="address" type="text" name="address">{{$contact->address}}</textarea>
                            <small class="text-danger form-text"> @error('address') {{$message}} @enderror </small>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 mb-3 text-center">
                        <button type="submit" name="contactdetails" class="btn btn-danger" >Update</button>
                    </div>
                </form>
                @else 
                <form method="post" action="{{route('uploadContactDetails')}}" class="row" enctype="multipart/form-data">
                    @csrf	
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="Mobile">Mobile Number <star>*</star></label>
                            <input  class="form-control" placeholder="Your Mobile No. here" id="Mobile" type="text" value="{{old('mobile')}}" name="mobile"/>
                            <small class="text-danger form-text"> @error('mobile') {{$message}} @enderror </small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="Mobile">Alt. Mobile Number</label>
                            <input  class="form-control" placeholder="Your Alt. Mobile here" id="Mobile" type="text" value="{{old('altmobile')}}" name="altmobile"/>
                            <small class="text-danger form-text"> @error('altmobile') {{$message}} @enderror </small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="Email">Email <star>*</star></label>
                            <input placeholder="Your Email here" class="form-control" id="Email" type="email" value="{{old('email')}}" name="email"/>
                            <small class="text-danger form-text"> @error('email') {{$message}} @enderror </small>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">    
                        <div class="form-group">
                            <label for="address">Address <star>*</star></label>
                            <textarea  placeholder="Your full address here" class="form-control" id="address" type="text" name="address">{{old('address')}}</textarea>
                            <small class="text-danger form-text"> @error('address') {{$message}} @enderror </small>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 mb-3 text-center">
                        <button type="submit" name="contactdetails" class="btn btn-primary" >Submit</button>
                    </div>
                </form>                   
                @endif
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
