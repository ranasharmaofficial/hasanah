@extends('schoolemployee.layouts.master')
@section('title','View Profile')
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
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title text-white">@yield('title')</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>Employee ID: </th>
                                    <td>{{$employeedetails->employeeID}}</td>
                                    <th>Registration No.: </th>
                                    <td>{{$employeedetails->registrationNumber}}</td>
                                </tr>
                                <tr>
                                    <th>Name: </th>
                                    <td>{{$employeedetails->employeeName}}</td>
                                    <th>Date of birth: </th>
                                    <td>{{$employeedetails->dob}}</td>
                                </tr>
                                <tr>
                                    <th>Gender: </th>
                                    <td>{{$employeedetails->gender}}</td>
                                    <th>Aadhar No.: </th>
                                    <td>{{$employeedetails->aadharNumber}}</td>
                                </tr>
                                <tr>
                                    <th>Pan No.: </th>
                                    <td>{{$employeedetails->panNumber}}</td>
                                    <th>Qualification: </th>
                                    <td>{{$employeedetails->qualification}}</td>
                                </tr>
                                <tr>
                                    <th>Experience (In year): </th>
                                    <td>{{$employeedetails->experience}}</td>
                                    <th>Alt. Mobile No.: </th>
                                    <td>{{$employeedetails->altMobile}}</td>
                                </tr>
                                <tr>                                    
                                    <th>Address: </th>
                                    <td>{{$employeedetails->addressOne}}
                                        @if ($employeedetails->addressTwo !== null)
                                        , {{$employeedetails->addressTwo}}
                                        @endif    
                                        , {{$employeedetails->city}}, {{$employeedetails->state}}, {{$employeedetails->country}}, {{$employeedetails->pinCode}}                         
                                    </td>
                                    <th>Current Address: </th>
                                    <td>
                                        {{$employeedetails->presentAddressOne}}
                                        @if ($employeedetails->presentAddressTwo !== null)
                                        , {{$employeedetails->presentAddressTwo}}
                                        @endif    
                                        , {{$employeedetails->presentCity}}, {{$employeedetails->presentState}}, {{$employeedetails->presentCountry}}, {{$employeedetails->presentPinCode}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
