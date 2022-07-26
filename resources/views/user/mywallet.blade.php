@extends('user.layouts.master')
@section('title','User Home')

@section('content')
<!-- jquery.vectormap css -->
<link href="{{asset('assets_admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="{{asset('assets_admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('assets_admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<style>
.css-selector {
    background: linear-gradient(270deg, #8336ee, #ee36e7);
    background-size: 400% 400%;

    -webkit-animation: AnimationName 30s ease infinite;
    -moz-animation: AnimationName 30s ease infinite;
    animation: AnimationName 30s ease infinite;
}

@-webkit-keyframes AnimationName {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
@-moz-keyframes AnimationName {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
@keyframes AnimationName {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 img_com">
                            <img src="{{asset('uploads/company-logo/'.$companydata->logo)}}" alt="" class="img-thumbnail imagefix">
                        </div>
                        <div class="col-sm-8">
                            <h4 class="dist_companyname text-primary">{{$companydata->company_name}}</h4>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title align-items-right text-right">
                        <h4 class="text-right">Designation :<span class="text-primary"> Contractor</span></h4>
                        <h4 class="">Last Login at :<span class="text-primary"> {{$lastLoginTime->created_at}}</span></h4>
                        <h4 class="mt-1">Name : <span class="text-primary"> {{ $LoggedContractInfo['name'] }}</span</h4>
                        <h4 class="mt-1">User Id :<span class="text-primary">  {{ $LoggedContractInfo['user_id'] }}</span</h4>
                    </div>


                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if (Session::has('alert-' . $msg))
                                    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                                        {{ Session::get('alert-' . $msg) }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                       
                        <div class="row justify-content-center">
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div style="background-color:#25b3c3;color:#fff;" class="card-header">My Wallet</div>
                                    <div class="card-body css-selector p-10">
                                        <div class="d-flex">
                                            <div class="flex-1 overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Total Earned</p>
                                                  <h4 class="mb-0 text-white">Rs&nbsp;{{$contractor_earned_amount}}.00</h4>  
                                            </div>
                                            <div class="text-white ms-auto">
                                                <i class="mdi mdi-currency-inr font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div  class="card-footer">
                                        <a href="{{url('user/wallet-history')}}"><button style="float:right;" class="btn btn-success">Wallet History</button></a>
                                    </div>
                                </div>
                            </div><!--End column--->
                            <div class="col-md-4">
                                <div class="card">
                                    <div style="background-color:#25b3c3;color:#fff;" class="card-header">Penalty Cut Off</div>
                                    <div class="card-body bg-danger p-10">
                                        <div class="d-flex">
                                            <div class="flex-1 overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Total Penalty Cut Off</p>
                                                  <h4 class="mb-0 text-white">Rs&nbsp;{{$penaltyCutOff}}.00</h4>  
                                            </div>
                                            <div class="text-white ms-auto">
                                                <i class="mdi mdi-currency-inr font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div  class="card-footer">
                                        <a href="{{url('user/wallet-history')}}"><button style="float:right;" class="btn btn-success">Wallet History</button></a>
                                    </div>
                                </div>
                            </div><!--End column--->
                        </div>
                    </div><!--End column--->
                </div>
                <!-- end row -->

                
            </div>

            
        </div>
        <!-- end row -->

       
    </div>

</div>
<!-- End Page-content -->

<!-- apexcharts -->
<script src="{{asset('assets_admin/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets_admin/js/pages/dashboard.init.js')}}"></script>
<!-- jquery.vectormap map -->
<script src="{{asset('assets_admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets_admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>
<!-- Required datatable js -->
<script src="{{asset('assets_admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets_admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{asset('assets_admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets_admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script>
    var x = document.getElementById("printlocation");
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
      x.innerHTML = "<b class='text-primary'>Latitude:</b> " + position.coords.latitude +
      ",&nbsp;<b class='text-primary'>Longitude:</b> " + position.coords.longitude;
    }
</script>
@endsection