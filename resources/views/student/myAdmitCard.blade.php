@extends('student.layouts.master')
@section('title','Entrance Exam Admit Card')
@section('content')
<style>
    body {
    background-color: #fff !important;
}
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
.receipt-address{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.7rem;
    margin: 0;
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

        @if ($trytodo)
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
                                    {{-- <div class="row">
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8"> 
                                            <img class="rounded" style="max-height: 90px" src="{{asset('assets_admin/images/logo-light.png')}}" alt="Hasanah Girls College">
                                            <h5>Hasanh Girls College</h5>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center p-0">
                                            <img src="{{asset('uploads/student-documents').'/'.$studentdetails->passport_photo}}" class="img-thumbnail" style="max-height:140px;" />
                                        </div>  
                                     </div> --}}
                                     <div class="row">
                                        <div class="col-xs-2 m-0 text-center"> 
                                            <img class="rounded" style="max-height: 70px" src="{{asset('assets_admin/images/logo-light.png')}}" alt="Hasanah Girls College" />
                                        </div>
                                        <div class="col-xs-8 m-0 text-center"> 
                                            <h6 class="m-0"><b>Hasanah Educational Trust</b></h6>
                                            <h5 class="receipt-address">AT- Tilko Bari, P.O- Farkia, District- Araria, Bihar, India(854304)</h5>
                                            <p style="margin: 0; font-weight: bold;font-size: 12px;">Contact No: +91 993 148 1362 Email: hasanah.india@gmail.com</p>
                                            <p style="margin: 0; font-weight: bold;font-size: 12px;">Website: www.hasanah.in Regd. No. 24/2019</p>
                                        </div>
                                        <div class="col-xs-2 text-center p-0 m-0">
                                            <p style="font-weight: 600;">Student Copy</p>
                                        </div>  
                                     </div>
                                </div>
                                <div class="BoxD">
                                    <div class="row">
                                        <div class="col-xs-8">
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
                                                  
                                                 </tbody>
                                              </table>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            
                                            <table class="table" style="margin:0; border-right: 0.8px solid gray;">
                                                <tbody>
                                                  <tr>
                                                      <td>
                                                          <img src="{{asset('uploads/student-documents').'/'.$studentdetails->passport_photo}}" class="img-thumbnail" style="height: 175px;width: 175px;" alt="{{$studentdetails->name}}'s Photo">
                                                      </td>
                                                  </tr>
                                                 </tbody>
                                              </table>
                                        </div>                                       
                                    </div>
                                </div>                                
                                <div class="BoxE border- padding mar-bot txt-center">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Examination Venue:</th>
                                                        <td colspan="3" style="text-align: left;">{{ucfirst($examschedules->exam_center)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Exam Date:</th>
                                                        <td>{{date('d-M-Y',strtotime($examschedules->exam_date))}}</td>
                                                        <th>Duration of Exam:</th>
                                                        <td>{{date("g:i a", strtotime($examschedules->exam_time_from)).'-'.date("g:i a", strtotime($examschedules->exam_time_to))}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="BoxF border- padding mar-bot txt-center">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Subject/Paper</th>
                                                        <th>Exam Date</th>
                                                    </tr>
                                                </thead>
                                              <tbody>
                                                <tr>
                                                  <td>1</td>
                                                  <td>ADCA</td>
                                                  <td>20 December 2020</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}
                                <footer class="txt-center">
                                    <h5 style="text-decoration: underline; font-weight: 600;">अभ्यर्थियों  के लिए सामान्य निर्देश</h5>
                                    </br>
                                    <ul>
                    <li style="text-align: justify;">अभ्यर्थियों को सलाह दी जाती है कि वे प्रवेश पत्र में दिए गए रिपोर्टिंग / प्रवेश-समय में निर्धारित समय स्लॉट&nbsp; अनुसार केंद्र पर पहुचें |</li>
                    <li style="text-align: justify;">अभ्यर्थी&nbsp;ध्यान दे कि किसी भी परिस्थिति में या किसी भी कारण से प्रवेश-समय के बाद किसी भी अभ्यर्थी को प्रवेश करने की अनुमति नहीं दी जाएगी | प्रवेश-समय के बाद गेटों को हर हाल में बंद कर दिया जाएगा |</li>
                    <li style="text-align: justify;">परीक्षा के लिए रिपोर्टिंग के समय सदैव निम्नलिखित अपने साथ लाएं&nbsp;
                    <ul>
                    <li style="text-align: justify;">प्रवेश पत्र |<br /></li>
                    <li style="text-align: justify;">पासपोर्ट आकर की अपनी नवीनतम रंगीन फोटो की तो प्रतियां (3 सेमी X 3 सेमी) | <br /></li>
                    <li style="text-align: justify;">फेस मास्क |</li>
                    </ul>
                    </li>
                    </ul>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        @else
            <div class="row justify-content-center">
                <div class="card col-sm-6">
                    <div class="card-body">
                        <h5 class="text-danger text-center">Your admit card not availabel.</h5>
                    </div>
                </div>
            </div>
        @endif
        
        
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
