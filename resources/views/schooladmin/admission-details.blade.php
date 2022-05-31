@extends('schooladmin.layouts.master')
@section('title','Admission Details')
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
                            <li class="breadcrumb-item"><a href="{{url('schooladmin/home')}}">Dashboard</a></li>
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
                                    <td>{{$admissiondetails->employeeID}}</td>
                                    <th>Registration No.: </th>
                                    <td>{{$admissiondetails->registrationNumber}}</td>
                                </tr>
                                <tr>
                                    <th>Name: </th>
                                    <td>{{$admissiondetails->employeeName}}</td>
                                    <th>Date of birth: </th>
                                    <td>{{$admissiondetails->dob}}</td>
                                </tr>
                                <tr>
                                    <th>Gender: </th>
                                    <td>{{$admissiondetails->gender}}</td>
                                    <th>Aadhar No.: </th>
                                    <td>{{$admissiondetails->aadharNumber}}</td>
                                </tr>
                                <tr>
                                    <th>Pan No.: </th>
                                    <td>{{$admissiondetails->panNumber}}</td>
                                    <th>Qualification: </th>
                                    <td>{{$admissiondetails->qualification}}</td>
                                </tr>
                                <tr>
                                    <th>Experience (In year): </th>
                                    <td>{{$admissiondetails->experience}}</td>
                                    <th>Alt. Mobile No.: </th>
                                    <td>{{$admissiondetails->altMobile}}</td>
                                </tr>
                                <tr>                                    
                                    <th>Address: </th>
                                    <td>{{$admissiondetails->addressOne}}
                                        @if ($admissiondetails->addressTwo !== null)
                                        , {{$admissiondetails->addressTwo}}
                                        @endif    
                                        , {{$admissiondetails->city}}, {{$admissiondetails->state}}, {{$admissiondetails->country}}, {{$admissiondetails->pinCode}}                         
                                    </td>
                                    <th>Current Address: </th>
                                    <td>
                                        {{$admissiondetails->presentAddressOne}}
                                        @if ($admissiondetails->presentAddressTwo !== null)
                                        , {{$admissiondetails->presentAddressTwo}}
                                        @endif    
                                        , {{$admissiondetails->presentCity}}, {{$admissiondetails->presentState}}, {{$admissiondetails->presentCountry}}, {{$admissiondetails->presentPinCode}}
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
