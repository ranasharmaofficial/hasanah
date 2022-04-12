@extends('student.layouts.master')
@section('title','Entrance Exam Admit Card')
@section('content')
<style>
.txt-center {
    text-align: center;
}
.border- {
    border: 1px solid rgb(156, 156, 156) !important;
}
.padding {
    padding: 15px;
}
.mar-bot {
    margin-bottom: 15px;
}
.admit-card {
    /* background-image: url('{{asset('front_assets/img/logo.jpeg')}}'); */
    background: linear-gradient(rgba(255, 255, 255,.9), rgba(248, 249, 249, .9)), url("{{asset('front_assets/img/logo.jpeg')}}");
    background-size: 160px;
    border: 2px solid #000;
    padding: 15px;
    margin: 20px 0;
}
.BoxA h5, .BoxA p {
    margin: 0;
}
h5 {
    text-transform: uppercase;
}
table img {
    width: 100%;
    margin: 0 auto;
}
.table-bordered td, .table-bordered th, .table thead th {
    border: 1px solid #000000 !important;
}
table tr td, table tr td b{
    color: rgb(0, 0, 0);
}
</style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">@yield('title')</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('student/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card" id="content">
                    <div class="card-header text-center avoid-this">
                        <button class="btn btn-danger printpage"><i class="fa fa-print"></i> Print Now</button>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="admit-card">
                                <div class="border- padding"> 
                                    <div class="row">
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8"> 
                                            <img class="rounded" style="max-height: 90px" src="{{asset('assets_admin/images/logo-light.png')}}" alt="Hasanah Girls College">
                                            <h5>Hasanh Girls College</h5>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center p-0">
                                            <img src="{{asset('uploads/student-documents').'/'.$studentdetails->passport_photo}}" class="img-thumbnail" style="max-height:140px;" />
                                        </div>  
                                     </div>
                                </div>
                                <div class="BoxD">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                              <tbody>
                                                <tr>
                                                    <td><b>Name : {{$studentdetails->name}}</b></td>
                                                    <td><b>Class : {{$studentdetails->class_id}}</b></td>
                                                </tr>
                                                 <tr>
                                                    <td><b>Mobile : {{$studentdetails->mobile}}</b></td>
                                                    <td><b>Email: </b> {{$studentdetails->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Country : {{$studentdetails->country}}</b></td>
                                                    <td><b>State: </b>{{$studentdetails->state}}</td>
                                                  </tr>
                                                <tr>
                                                  <td><b>City : </b>{{$studentdetails->city}}</td>
                                                  <td><b>Pin Code: </b>{{$studentdetails->pincode}}</td>
                                                </tr>
                                                <tr>
                                                  <td><b>Registration Amount : </b>&#8377;&nbsp;{{$studentdetails->registration_fee}}</td>
                                                  <td><b>Transaction Id : </b>{{$studentdetails->transaction_id}}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td><b>Aadhar Card : </b><img src="{{asset('uploads/student-documents').'/'.$studentdetails->aadhar_card}}" class="img-thumbnail" style="max-height:140px;" /></td>
                                                    <td><b>Father's Aadhar Card: </b><img src="{{asset('uploads/student-documents').'/'.$studentdetails->father_aadhar_card}}" class="img-thumbnail" style="max-height:180px;" /></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Last Year Makrsheet : </b><img src="{{asset('uploads/student-documents').'/'.$studentdetails->last_year_exam_marksheet}}" class="img-thumbnail" style="max-height:180px;" /></td>
                                                </tr> --}}
                                               
                                               </tbody>
                                            </table>
                                        </div>
                                       
                                    </div>
                                </div>                                
                                {{-- <footer class="text-center">
                                    <h5 class="text-center text-primary text-lowercase p-0 m-0">Visit : <span class="text-lowercase">www.prabuddham.co.in</span></h5>                                    
                                </footer>                                 --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('assets_admin/js/jQuery.print.js') }}"></script>
    <script type='text/javascript'>
    jQuery(function($) {
        $("#content").find('button').on('click', function() {            
            // alert('Test')
            // $.print("#content");
            //Print ele4 with custom options
            $("#content").print({
            // Use Global styles
            globalStyles: true,
            // Add link with attrbute media=print
            mediaPrint: false,
            //Custom stylesheet
            stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
            //Print in a hidden iframe
            iframe: false,
            // Don't print this
            noPrintSelector: ".avoid-this",
            // Add this on top
            append: "Admit Card",
            // Add this at bottom
            // prepend: "https://prabuddham.co.in/",
            // Manually add form values
            manuallyCopyFormValues: true,
            // resolves after print and restructure the code for better maintainability
            deferred: $.Deferred(),
            // timeout
            timeout: 250,
            // Custom title
            title: null,
            // Custom document type
            doctype: '<!doctype html>'
        });
        });
    });
    </script>
@endsection
