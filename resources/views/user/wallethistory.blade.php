@extends('user.layouts.master')
@section('title','Wallet History')
@section('content')
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
            <div class="col-12">
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
                <div class="card">
                    <div class="card-header bg-success">
                        <h4 class="card-title text-white">@yield('title')</h4>
                    </div>
                    <div class="card-body">
                       
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-dark">
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Approved by</th>
                                    <th>Project Id</th>
                                    <th>Project&nbsp;Name</th>
                                    <th>Project&nbsp;Number</th>
                                    <th>Received Amount</th>
                                    <th>Penalty Cut Off</th>
                                    <th>Received&nbsp;Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($walletHitory as $key => $data)
                                @php
                                    $ldate = date('Y-m-d');
                                    $datedays = strtotime($data->no_of_days)-strtotime($ldate);
                                    $datediff = (round($datedays / 86400));
                                @endphp
                                <tr>
                                    <td>{{($walletHitory->currentpage()-1) * $walletHitory->perpage() + $key + 1}}</td>
                                    <td>{{$data->ApprovedDistributor}}</td>
                                    <td>{{$data->project_id}}</td>
                                    <td>{{$data->project_name}}
                                        {{$data->ContID}}
                                    </td>
                                    <td>{{$data->project_number}}</td>
                                   
                                    <td>Rs&nbsp;{{$data->getContAmount}}</td>
                                    <td>Rs&nbsp;{{$data->penaltyAmount}}</td>
                                    <td>{{$data->amountRecDate}}</td>
                                    
                                    <td>
                                        {{-- <form method="get" enctype="multipart/form-data" action="{{route('user/upload-image')}}">
                                            @csrf
                                            <input type="hidden" value="{{$data->project_id}}" name="project_id">
                                            <input type="hidden" value="{{$data->user_id}}" name="user_id">
                                            <input type="hidden" value="{{$data->distributor_id}}" name="distributor_id">
                                            <button type="submit" class="btn btn-info btn-sm">Upload&nbsp;Image</button>
                                        </form>
                                        <a href="{{url('user/upload-video')}}"><button class="btn btn-success btn-sm">Upload&nbsp;Video</button></a> --}}
                                        <form action="{{route('user/viewProjectDetails')}}" method="get" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$data->project_id}}" name="project_id">
                                            <button type="submit" class="btn btn-danger btn-sm">View&nbsp;Project&nbsp;Details</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">Project Not Available</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="7">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                {{$walletHitory->links();}}
                                            </ul>
                                        </nav>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
