@extends('admin.layouts.master')
@section('title','View Student')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="" class="row" enctype="multipart/form-data">
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="Mobile">Student Roll Number <star>*</star></label>
                                    <input class="form-control" id="Mobile" required type="text"
                                         name="id" />
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Official Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Academic Year : </th>
                                    <td>2020-2021 </td>
                                </tr>
                                <tr>
                                    <th>Admission Number : </th>
                                    <td>1234 </td>
                                </tr>
                                <tr>
                                    <th>Joining Date : </th>
                                    <td>12/01/2000 </td>
                                </tr>
                                <tr>
                                    <th>Batch Timing : </th>
                                    <td>1234 </td>
                                </tr>
                                <tr>
                                    <th>Roll Number : </th>
                                    <td>1234 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col sm-6 -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Personal Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Full Name : </th>
                                    <td>Rana Sharma </td>
                                </tr>
                                <tr>
                                    <th>Date of Birth : </th>
                                    <td>01/01/2000 </td>
                                </tr>
                                <tr>
                                    <th>Gender : </th>
                                    <td>Male </td>
                                </tr>
                                <tr>
                                    <th>Blood Group : </th>
                                    <td>O +ve</td>
                                </tr>
                                <tr>
                                    <th>Birth Place : </th>
                                    <td>Purnia </td>
                                </tr>
                                <tr>
                                    <th>Aadhar Number : </th>
                                    <td>Rana Sharma </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col sm-6 -->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Contact Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Persent Address : </th>
                                    <td>Srinagar </td>
                                </tr>
                                <tr>
                                    <th>Permanent Address : </th>
                                    <td>Janta Chowk Purnia </td>
                                </tr>
                                <tr>
                                    <th>State : </th>
                                    <td>Bihar </td>
                                </tr>
                                <tr>
                                    <th>City : </th>
                                    <td>Araria</td>
                                </tr>
                                <tr>
                                    <th>Pin Code : </th>
                                    <td>854301 </td>
                                </tr>
                                <tr>
                                    <th>Mobile Number : </th>
                                    <td>8825171386 </td>
                                </tr>
                                <tr>
                                    <th>Alt. Mobile Number : </th>
                                    <td>9199758612 </td>
                                </tr>
                                <tr>
                                    <th>Mobile Number : </th>
                                    <td>8825171386 </td>
                                </tr>
                                <tr>
                                    <th>Email ID : </th>
                                    <td>iamranasharma@gmail.com </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col  sm-6-->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Father Details</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Father's Name : </th>
                                    <td>Father name </td>
                                </tr>
                                <tr>
                                    <th>Father's Mobile No. : </th>
                                    <td>651684651 </td>
                                </tr>
                                <tr>
                                    <th>Job : </th>
                                    <td>Business Man </td>
                                </tr>
                                <tr>
                                    <th>Father's Aadhar Number : </th>
                                    <td>612651651615</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col  sm-6-->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Mother Details</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Mother's Name : </th>
                                    <td>Mother name </td>
                                </tr>
                                <tr>
                                    <th>Mother's Mobile No. : </th>
                                    <td>651684651 </td>
                                </tr>
                                <tr>
                                    <th>Job : </th>
                                    <td>Business Man </td>
                                </tr>
                                <tr>
                                    <th>Mother's Aadhar Number : </th>
                                    <td>612651651615</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col  sm-6-->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection