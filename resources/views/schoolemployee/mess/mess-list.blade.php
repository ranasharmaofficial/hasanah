@extends('schoolemployee.layouts.master')
@section('title','Mess Stock List')
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
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">@yield('title')</h3>
                        <p class="p-0 m-0 text-white">Total Mess Stock: <b>{{$stocklist->total();}}</b>, Page No: <b>{{$stocklist->currentPage();}}</b></p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Purchase Date</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Amount</th>
                                    <th>Total Amount</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stocklist as $key => $data)
                                <tr>
                                    <td>{{($stocklist->currentpage()-1) * $stocklist->perpage() + $key + 1}}</td>
                                    <td>{{$data->purchased_date}}</td>
                                    <td>{{$data->item_name}}</td>
                                    <td>{{$data->quantity}}</td>
                                    <td>{{$data->unit}}</td>
                                    <td>Rs&nbsp;{{$data->amount}}</td>
                                    <td>Rs&nbsp;{{$data->total_amount}}</td>
                                    <td>{{$data->created_at}}</td>
                                </tr>                                    
                                @empty
                                <tr>
                                    <td colspan="7" class="text-danger text-center">Data not availabel</td>                                    
                                </tr>                                    
                                @endforelse
                                <tr>
                                    <td colspan="7">
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end mb-0">
                                                {{$stocklist->links();}}
                                            </ul>
                                        </nav>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
