<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    
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
</head>
<body>
    <h1>{{ $studentse->form_id }}</h1>
    <p>{{ $studentse->student_id }}</p>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="admit-card">
                                <div class="border- padding"> 
                                    <div class="row">
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8"> 
                                            {{-- <img class="rounded" style="max-height: 90px" src="{{asset('assets_admin/images/logo-light.png')}}" alt="Hasanah Girls College"> --}}
                                            <h5>Hasanh Girls College</h5>
                                        </div>
                                        {{-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center p-0">
                                            <img src="{{asset('uploads/student-documents').'/'.$studentse->passport_photo}}" class="img-thumbnail" style="max-height:140px;" />
                                        </div>   --}}
                                     </div>
                                </div>
                                <div class="BoxD">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                              <tbody>
                                                <tr>
                                                    <td><b>Name : {{$studentse->name}}</b></td>
                                                    <td><b>Class : {{$studentse->class_id}}</b></td>
                                                </tr>
                                                 <tr>
                                                    <td><b>Mobile : {{$studentse->mobile}}</b></td>
                                                    <td><b>Email: </b> {{$studentse->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Country : {{$studentse->country}}</b></td>
                                                    <td><b>State: </b>{{$studentse->state}}</td>
                                                  </tr>
                                                <tr>
                                                  <td><b>City : </b>{{$studentse->city}}</td>
                                                  <td><b>Pin Code: </b>{{$studentse->pincode}}</td>
                                                </tr>
                                                <tr>
                                                  <td><b>Registration Amount : </b>&#8377;&nbsp;{{$studentse->registration_fee}}</td>
                                                  <td><b>Transaction Id : </b>{{$studentse->transaction_id}}</td>
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
        </div>

    </div>
</body>
</html>