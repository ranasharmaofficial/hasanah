@extends('user.layouts.master')
@section('title', 'Bank Details')
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
            @if ($contractdata->bank_name !== null && $contractdata->account_number !== null)
                <div class="row justify-content-center">
                    <div class="col-sm-6 card">
                        <div class="card-header bg-primary">
                            <h3 class="text-white card-title">@yield('title')</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Bank Name</th>
                                            <td>{{$contractdata->bank_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Branch</th>
                                            <td>{{$contractdata->branch}}</td>
                                        </tr>
                                        <tr>
                                            <th>Account Holder Name</th>
                                            <td>{{$contractdata->account_holder_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>IFSC Code</th>
                                            <td>{{$contractdata->ifsc_code}}</td>
                                        </tr>
                                        <tr>
                                            <th>Account Number</th>
                                            <td>{{$contractdata->account_number}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">@yield('title')</h4>
                        </div>
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
                            @if (isset($rsultpass))
                            <form action="{{route('user.update-bank-details')}}" method="POST" enctype="multipart/form-data" class="row">
                                @csrf
                                <div class="col-sm-6 form-group mb-3">
                                    <label for="bankName">Bank Name</label>
                                    <input type="text" required name="bank_name" id="bankName" value="{{$bank->BANK}}" readonly placeholder="Enter Bank Name" class="form-control">
                                    <small class="form-text text-danger">@error('bank_name')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label for="ifsc">IFSC Code</label>
                                    <input type="text" required name="ifsc_code" id="ifsc" value="{{$bank->IFSC}}" readonly placeholder="Enter IFSC Code" class="form-control">
                                    <small class="form-text text-danger">@error('ifsc_code')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label for="branch">Branch</label>
                                    <input type="text" required name="branch" id="branch" value="{{$bank->BRANCH}}" readonly placeholder="Branch" class="form-control">
                                    <small class="form-text text-danger">@error('branch')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label for="accountholdername">Enter Account Holder Name</label>
                                    <input type="text" required name="account_holder_name" id="accountholdername" placeholder="Enter Account Holder Name" class="form-control">
                                    <small class="form-text text-danger">@error('account_holder_name')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label for="accountnumber">Enter Account Number</label>
                                    <input type="password" required name="account_number" id="accountnumber" placeholder="Enter Account Number" class="form-control">
                                    <small class="form-text text-danger">@error('account_number')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label for="caccountnumber">Enter Confirm Account Number</label>
                                    <input type="tel" required name="confirm_account_number" id="caccountnumber" placeholder="Enter Confirm Account Number" class="form-control">
                                    <small class="form-text text-danger">@error('confirm_account_number')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-12 form-group mb-3 text-center">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit Now</button>
                                </div>
                            </form>
                            @else
                            <form action="{{route('user.fetch-bank-details')}}" method="get" class="row">
                                @csrf
                                <div class="col-sm-12 form-group">
                                    <label for="ifsc">Enter IFSC Code</label>
                                    <input type="text" required name="ifsc_code" placeholder="Enter IFSC Code" class="form-control">
                                    <small class="form-text text-danger">@error('ifsc_code')
                                        {{$message}}
                                    @enderror</small>
                                </div>
                                <div class="col-sm-12 form-group mt-3">
                                    <button class="btn btn-primary">Fetch Details</button>
                                </div>
                            </form>
                            @endif							
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
            @endif
            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
