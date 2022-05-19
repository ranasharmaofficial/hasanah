@extends('student.layouts.master')
@section('title','Admission Payment Slip')
@section('content')
<style>
    body{
        background: none;
    }
.txt-center {
    text-align: center;
}
.border- {
    border: 1px solid rgb(156, 156, 156) !important;
}
.padding {
    padding: 5px;
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
.fee-receipt{
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-weight: 600;
    font-size: 0.8rem;
    text-decoration: underline;
    margin: 0;
}
.receipt-address{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.7rem;
    margin: 0;
}
.table > :not(caption) > * > * {
    padding: 0 0 0 2px !important;
}
.table tbody td b{
    font-size: 10px;
}
.table tbody td{
    font-size: 10px;
}
.table tbody th{
    font-size: 11px;
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
                <div class="card p-0 m-0" id="content">
                    <div class="card-header text-center avoid-this">
                        <button class="btn btn-danger printpage"><i class="fa fa-print"></i> Print Now</button>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="admit-card">
                                <div class="border- padding"> 
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
                                            <p style="font-weight: 600;">Parent Copy</p>
                                        </div>  
                                     </div>
                                </div>
                                <div class="BoxD">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                              <tbody>
                                                  <tr>
                                                    <th colspan="6" class="text-center">
                                                        <h6 class="fee-receipt">FEE RECEIPT</h6>
                                                    </th>
                                                  </tr>
                                                <tr>
                                                    <td colspan="3"><b>Receipt No. : {{$getfeedetails->receipt_no}}</b></td>
                                                    <td colspan="3"><b>Date : {{$getfeedetails->transaction_date}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>Name of Student : {{$getdetails->name}}</b></td>
                                                    <td colspan="3"><b>Class & Section : {{$getcourse->class_name}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>Admission Number : {{$getadmissiondetails->admissionNumber}}</b></td>
                                                    <td colspan="3"><b>Mobile Number : {{$getdetails->mobile}}</b></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span style="font-size: 1.2rem;color:rgb(138, 137, 137);font-size: 14px;">Personal Information</span></th>
                                                </tr>
                                                 <tr class="text-center">
                                                    <th><b>Sl.&nbsp;No.</b></th>
                                                    <th>Description</th>
                                                    <th>Due</th>
                                                    <th>Concession</th>
                                                    <th>Paid Amount</th>
                                                    <th>Balance</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>1</td>
                                                    <td>Admission Fee</td>
                                                    <td>{{$getfeedetails->admissionFee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->admissionFee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>2</td>
                                                    <td>Security Deposit</td>
                                                    <td>{{$getfeedetails->security_deposit}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->security_deposit}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>3</td>
                                                    <td>Annual Fee</td>
                                                    <td>{{$getfeedetails->annual_fee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->annual_fee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>4</td>
                                                    <td>Miscellanous Fee</td>
                                                    <td>{{$getfeedetails->miscellanous_fee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->miscellanous_fee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>5</td>
                                                    <td>Tuition Fee</td>
                                                    <td>{{$getfeedetails->tutionFee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->tutionFee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td></td>
                                                    <td><b>Grand Total</b></td>
                                                    <td><b>{{$getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee}}.00</b></td>
                                                    <td><b>0.00</b></td>
                                                    <td><b>{{$getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee}}.00</b></td>
                                                    <td><b>0.00</b></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" colspan="6"><span style="font-size: 1.2rem;color:rgb(138, 137, 137);font-size: 14px;">Pay Mode Information</span></th>
                                                </tr>
                                                <tr class="text-center">
                                                    <td><b>Sl.&nbsp;No.</b></td>
                                                    <td><b>Pay&nbsp;Mode</b></td>
                                                    <td><b>Method</b></td>
                                                    <td><b>Transaction No</b></td>
                                                    <td><b>Transaction Date</b></td>
                                                    <td><b>Amount</b></td>
                                                </tr> 
                                                <tr class="text-center">
                                                    <td>1</td>
                                                    <td>Online</td>
                                                    <td>{{$getfeedetails->method}}</td>
                                                    <td>{{$getfeedetails->transaction_id}}</td>
                                                    <td>{{$getfeedetails->transaction_date}}</td>
                                                    <td>{{$getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee}}.00</td>
                                                </tr> 
                                                <tr>
                                                    <th class="text-left" colspan="6"><span style="color:rgb(59, 57, 57);">Total in Words: @php
                                                        $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                    @endphp Rupees {{$digit->format($getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee)}} only</span></th>
                                                </tr> 
                                                <tr>
                                                    <th class="text-left" colspan="6"><span style="font-size: 1.0rem;color:rgb(59, 57, 57);font-size: 12px;">NOTE : Payment will not be refundable. </span></th>
                                                </tr>  
                                                <tr style="text-align: right;">
                                                    <td colspan="6" style="font-size: 1rem; padding-right: 10px;">Signature</td>
                                                </tr>                                             
                                               </tbody>
                                            </table>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <hr style="border-top: 1px dashed red; padding: 0; margin: 0;">
                            <div class="admit-card">
                                <div class="border- padding"> 
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
                                            <p style="font-weight: 600;">Office Copy</p>
                                        </div>  
                                     </div>
                                </div>
                                <div class="BoxD">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                              <tbody>
                                                  <tr>
                                                    <th colspan="6" class="text-center">
                                                        <h6 class="fee-receipt">FEE RECEIPT</h6>
                                                    </th>
                                                  </tr>
                                                <tr>
                                                    <td colspan="3"><b>Receipt No. : {{$getfeedetails->receipt_no}}</b></td>
                                                    <td colspan="3"><b>Date : {{$getfeedetails->transaction_date}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>Name of Student : {{$getdetails->name}}</b></td>
                                                    <td colspan="3"><b>Class & Section : {{$getcourse->class_name}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>Admission Number : {{$getadmissiondetails->admissionNumber}}</b></td>
                                                    <td colspan="3"><b>Mobile Number : {{$getdetails->mobile}}</b></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"><span style="font-size: 1.2rem;color:rgb(138, 137, 137);font-size: 14px;">Personal Information</span></th>
                                                </tr>
                                                 <tr class="text-center">
                                                    <th><b>Sl.&nbsp;No.</b></th>
                                                    <th>Description</th>
                                                    <th>Due</th>
                                                    <th>Concession</th>
                                                    <th>Paid Amount</th>
                                                    <th>Balance</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>1</td>
                                                    <td>Admission Fee</td>
                                                    <td>{{$getfeedetails->admissionFee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->admissionFee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>2</td>
                                                    <td>Security Deposit</td>
                                                    <td>{{$getfeedetails->security_deposit}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->security_deposit}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>3</td>
                                                    <td>Annual Fee</td>
                                                    <td>{{$getfeedetails->annual_fee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->annual_fee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>4</td>
                                                    <td>Miscellanous Fee</td>
                                                    <td>{{$getfeedetails->miscellanous_fee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->miscellanous_fee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>5</td>
                                                    <td>Tuition Fee</td>
                                                    <td>{{$getfeedetails->tutionFee}}.00</td>
                                                    <td>0.00</td>
                                                    <td>{{$getfeedetails->tutionFee}}.00</td>
                                                    <td>0.00</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td></td>
                                                    <td><b>Grand Total</b></td>
                                                    <td><b>{{$getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee}}.00</b></td>
                                                    <td><b>0.00</b></td>
                                                    <td><b>{{$getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee}}.00</b></td>
                                                    <td><b>0.00</b></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" colspan="6"><span style="font-size: 1.2rem;color:rgb(138, 137, 137);font-size: 14px;">Pay Mode Information</span></th>
                                                </tr>
                                                <tr class="text-center">
                                                    <td><b>Sl.&nbsp;No.</b></td>
                                                    <td><b>Pay&nbsp;Mode</b></td>
                                                    <td><b>Method</b></td>
                                                    <td><b>Transaction No</b></td>
                                                    <td><b>Transaction Date</b></td>
                                                    <td><b>Amount</b></td>
                                                </tr> 
                                                <tr class="text-center">
                                                    <td>1</td>
                                                    <td>Online</td>
                                                    <td>{{$getfeedetails->method}}</td>
                                                    <td>{{$getfeedetails->transaction_id}}</td>
                                                    <td>{{$getfeedetails->transaction_date}}</td>
                                                    <td>{{$getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee}}.00</td>
                                                </tr> 
                                                <tr>
                                                    <th class="text-left" colspan="6"><span style="color:rgb(59, 57, 57);">Total in Words: @php
                                                        $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                    @endphp Rupees {{$digit->format($getfeedetails->admissionFee + $getfeedetails->tutionFee + $getfeedetails->annual_fee + $getfeedetails->security_deposit + $getfeedetails->miscellanous_fee)}} only</span></th>
                                                </tr> 
                                                <tr>
                                                    <th class="text-left" colspan="6"><span style="font-size: 1.0rem;color:rgb(59, 57, 57);font-size: 12px;">NOTE : Payment will not be refundable. </span></th>
                                                </tr>  
                                                <tr style="text-align: right;">
                                                    <td colspan="6" style="font-size: 1rem; padding-right: 10px;">Signature</td>
                                                </tr>                                             
                                               </tbody>
                                            </table>
                                        </div>
                                       
                                    </div>
                                </div>
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
            append: "Admission Payment Slip",
            // Add this at bottom
            // prepend: "http://hasanah.in/",
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
