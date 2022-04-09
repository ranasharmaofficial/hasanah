@extends('student.layouts.master')
@section('title','Student Details')
@section('content')
 <div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title align-items-right text-right">
                        <h4 class="text-right"><span class="text-primary"> Student Panel</span></h4>
                     </div>


                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-info">Preview</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Class</td>
                                    <td class="text-right">Name</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>Pin Code</td>
                                    <td class="text-right">name</td>
                                </tr>
                                <tr>
                                    <td>Registration Amount</td>
                                    <td class="text-right">name</td>
                                </tr>
                            </tbody>
                        </table>   

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
