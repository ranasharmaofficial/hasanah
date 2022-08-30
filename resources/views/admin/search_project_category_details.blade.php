@extends('admin.layouts.master')
@section('title','Search Project Category')
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
            <div class="col-12">
                <div class="card">
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
                    {{-- @php
                        $cid= $_GET['company_id'];
                        $companyName = \App\Models\Company::where('company_id',$cid)->get();
                        echo $companyName; 
                    @endphp --}}
                    <div class="card-header bg-danger rounded">
                        <h3 class="card-title text-white">Showing results of <span style="color:yellow">"{{$company_name}}"</span> Company</h3>
                        <p class="p-0 m-0 text-white">Total Category: <b>{{$projectcategories->total();}}</b>, Page No: <b>{{$projectcategories->currentPage();}}</b></p>
                    </div>
                    <div class="card-body table-responsive">                        
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Project Category id</th>
                                <th>Category name</th>
                                <th>Project amount</th>
                                <th>Distribute amount</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($projectcategories as $key => $data)
                            <tr>
                                <td>{{($projectcategories->currentpage()-1) * $projectcategories->perpage() + $key + 1}}</td>
                                <td>{{$data->project_cat_id}}</td>
                                <td>{{$data->project_category}}</td>
                                <td>{{ $data->currency }}&nbsp;{{$data->project_amount}}/-</td>
                                <td>Rs&nbsp;{{$data->distribute_amount}}/-</td>
                                
                                <td>{{$data->created_at->format('d-m-Y')}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupVerticalDrop1" type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                            <a class="dropdown-item" href="{{ url('admin/project-category-edit/'.$data->id) }}">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td class="text-center">
                                    @if ($data->status == 0)
                                    <form action="{{route('unBlockUserContract')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                        <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i>&nbsp;Un-Block</button>
                                    </form>
                                    @else
                                    <form action="{{route('blockUserContract')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" value="{{$data->user_id}}" name="userid" required>
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i>&nbsp;Block</button>
                                    </form>
                                    @endif
                                    <button type="button" class="btn btn-info d-inline" title="View Details" onclick="showDetails(this)" id="{{$data->user_id}}"><i class="fa fa-eye"></i></button>
                                </td> --}}
                            </tr>
                            @endforeach
                            {{-- <tr>
                                <td colspan="7">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{$projectcategories->links();}}
                                        </ul>
                                    </nav>
                                </td>
                            </tr> --}}
                            </tbody>                                                        
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
		 
        
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    /*
    jQuery(document).ready(function(){
        jQuery('#district').change(function(){
            let districtid=jQuery(this).val();
            
    $('#block').empty();
    $('#block').append(`<option value="" disabled selected>Processing...</option>`);
            jQuery.ajax({
                url:'{{url('getBlocks')}}',
                type:'post',
                async: true,
                cache: false,
                data:'districtid=' + districtid + '&_token={{csrf_token()}}',
                success:function(response){
                    jQuery('#block').html(response)
                }
            });
        });
    });
    */
</script>
@endsection
