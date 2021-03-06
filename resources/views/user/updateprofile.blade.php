@extends('user.layouts.master')
@section('title', 'Update Profile')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 img_com">
                                <img src="{{asset('uploads/company-logo/'.$companydata->logo)}}" alt="" class="img-thumbnail imagefix">
                            </div>
                            <div class="col-sm-8">
                                <h4 class="dist_companyname text-primary">{{$companydata->company_name}}</h4>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title align-items-right text-right">
                            <h4 class="text-right">Designation :<span class="text-primary"> Contractor</span></h4>
                            <h4 class="">Last Login at :<span class="text-primary"> {{$lastLoginTime->created_at}}</span></h4>
                            <h4 class="mt-1">Name : <span class="text-primary"> {{ $LoggedContractInfo['name'] }}</span</h4>
                            <h4 class="mt-1">User Id :<span class="text-primary">  {{ $LoggedContractInfo['user_id'] }}</span</h4>
                        </div>
    
    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-12">
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
							<h4 class="card-title">@yield('title')</h4>
                            <form action="{{route('user.user-profile-update')}}" method="POST" class="row">
                                @csrf
                                <div class="col-sm-6">
                                    <label for="Project" class="col-form-label">Name <star>*</star></label>
                                    <input type="text" class="form-control" value="{{$userData->name}}" name="name" id="Project" required>
                                    <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Mobile" class="col-form-label">Mobile <star>*</star></label>
                                    <input type="text" class="form-control" name="mobile" id="Mobile" value="{{$userData->mobile}}" readonly required>
                                    <small class="form-text text-danger">@error('mobile') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Email" class="col-form-label">Email <star>*</star></label>
                                    <input type="text" class="form-control" name="email" id="Email" value="{{$userData->email}}" readonly required>
                                    <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="landmark" class="col-form-label">Landmark <star>*</star></label>
                                    <input type="text" value="{{$contractorData->landmark}}" class="form-control" name="landmark" id="landmark" required>
                                    <small class="form-text text-danger">@error('landmark') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="city" class="col-form-label">City <star>*</star></label>
                                    <input type="text" value="{{$contractorData->city}}" class="form-control" name="city" id="city" required>
                                    <small class="form-text text-danger">@error('city') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="state" class="col-form-label">State <star>*</star></label>
                                    <input type="text" value="{{$contractorData->state}}" class="form-control" name="state" id="state" required>
                                    <small class="form-text text-danger">@error('state') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="country" class="col-form-label">Country <star>*</star></label>
                                    <input type="text" value="{{$contractorData->country}}" class="form-control" name="country" id="country" required>
                                    <small class="form-text text-danger">@error('country') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="pincode" class="col-form-label">Pin Code <star>*</star></label>
                                    <input type="text" value="{{$contractorData->pincode}}" class="form-control" name="pincode" id="pincode" required>
                                    <small class="form-text text-danger">@error('pincode') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="submit" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
