@extends('dashboard.layout.master')
@section('title')Profile @endsection
@section('header-title')Profile @endsection

@section('content')
    <main role="main" class="ion-content ion-myprofile">
        <div class="mb-2 card bg-white profile-box text-center">
            <div class="py-4 px-3 border-bottom">
                <img alt="img" class="img-fluid mt-2 rounded-circle" src="{{asset('assets_dash/user/1.jpg')}}">
                <h5 class="font-weight-bold text-dark mb-1 mt-4">Student Name</h5>
                <p class="mb-0 text-muted">CLASS - 5(A)</p>
            </div>
            {{-- <div class="d-flex">
                <div class="col-6 border-right p-3">
                    <a class="card-link-style" href="myaddress.html">
                        <h6 class="font-weight-bold text-dark mb-1">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                        </h6>
                        <p class="mb-0 text-black-50 small">Edit Address</p>
                    </a>
                </div>
                <div class="col-6 p-3">
                    <a class="card-link-style" href="editprofile.html">
                        <h6 class="font-weight-bold text-dark mb-1">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </h6>
                        <p class="mb-0 text-black-50 small">Edit Profile</p>
                    </a>
                </div>
            </div> --}}
            <div [routerLink]="['/mywallet']"
                class="overflow-hidden border-top p-3 d-flex justify-content-between align-items-center">
                <small class="text-secondary font-weight-bold">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    Dues Amount:
                </small>
                <small class="text-primary font-weight-bold">Rs: 4,543,00/-</small>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-indigo text-white font-weight-bold">
                General Details
            </div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Admission&nbsp;Number:</th>
                        <td>546541231</td>
                    </tr>
                    <tr>
                        <th>Class:</th>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th>Batch:</th>
                        <td>A (2022-23)</td>
                    </tr>
                    <tr>
                        <th>Admission Date:</th>
                        <td>15 July 2017</td>
                    </tr>
                    <tr>
                        <th>Gurdian&nbsp;Name:</th>
                        <td>Enter Gurdian Name</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card">
            <div class="card-header bg-indigo text-white font-weight-bold">
                Personal Details
            </div>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Admission&nbsp;Number:</th>
                        <td>546541231</td>
                    </tr>
                    <tr>
                        <th>Class:</th>
                        <td>5</td>
                    </tr>
                    <tr>
                        <th>Batch:</th>
                        <td>A (2022-23)</td>
                    </tr>
                    <tr>
                        <th>Admission Date:</th>
                        <td>15 July 2017</td>
                    </tr>
                    <tr>
                        <th>Gurdian&nbsp;Name:</th>
                        <td>Enter Gurdian Name</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
