@extends('student.layouts.master')
@section('title','Entrance Exam Form Preview')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .razorpay-payment-button {
        color: white !important;
        background-color: #fa3424;
        border-color: #fa3424;
        font-size: 14px;
        width: 100%;
        height: 45px;
        text-align: center;
        border-radius: 2px;
        padding: 10px;
    }
    </style>
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
                    <div class="card-header text-white bg-primary">@yield('title')</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>Class</td>
                                    <td class="text-right">{{$classname->class_name}}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td class="text-right">{{$getdetails->name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td class="text-right">{{$getdetails->mobile}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="text-right">{{$getdetails->email}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td class="text-right">{{$getdetails->country}}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td class="text-right">{{$getdetails->state}}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td class="text-right">{{$getdetails->city}}</td>
                                </tr>
                                <tr>
                                    <td>Pin Code</td>
                                    <td class="text-right">{{$getdetails->pincode}}</td>
                                </tr>
                                <tr>
                                    <td>Registration Amount</td>
                                    <td class="text-right text-danger">&#8377;&nbsp;{{$getdetails->registration_fee}}/-</td>
                                </tr>
                            </tbody>
                        </table>   
                        <div class="row justify-content-center">
                            <div class="col-sm-2 text-center">
                                <form action="{{route('student.entrance-final-submit')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="tokenno" required value="{{$getdetails->token_no}}" />
                                    <input type="hidden" name="class_id" required value="{{$getdetails->class_id}}" />
                                    <input type="hidden" name="name" required value="{{$getdetails->name}}" />
                                    <input type="hidden" name="email" required value="{{$getdetails->email}}" />
                                    <input type="hidden" name="mobile" required value="{{$getdetails->mobile}}" />
                                    <input type="hidden" name="country" required value="{{$getdetails->country}}" />
                                    <input type="hidden" name="state" required value="{{$getdetails->state}}" />
                                    <input type="hidden" name="city" required value="{{$getdetails->city}}" />
                                    <input type="hidden" name="pincode" required value="{{$getdetails->pincode}}" />
                                    <input type="hidden" name="aadhar_card" required value="{{$getdetails->aadhar_card}}" />
                                    <input type="hidden" name="father_aadhar_card" required value="{{$getdetails->father_aadhar_card}}" />
                                    <input type="hidden" name="last_year_exam_marksheet" required value="{{$getdetails->last_year_exam_marksheet}}" />
                                    <input type="hidden" name="registration_fee" required value="{{$getdetails->registration_fee}}" />
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="{{$getdetails->registration_fee}}00"
                                            data-buttontext="Pay Now"
                                            data-name="Hasanah Girls College"
                                            data-description="Hasanah girls college entrance exam form"
                                            data-image="{{asset('assets_admin/images/logo-light.png')}}"
                                            data-prefill.name="{{$getdetails->name}}"
                                            data-prefill.email="{{$getdetails->email}}"
                                            data-prefill.contact="{{$getdetails->mobile}}"
                                            data-theme.color="#A4139D">
                                    </script>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
