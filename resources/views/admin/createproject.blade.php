@extends('admin.layouts.master')
@section('title','Create Project')
@section('content')
    <style>
        .FEF1F1{
            background-color: #FEF1F1;
        }
    </style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 text-white bg-primary p-2 rounded">@yield('title')</h4>

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
                    <div class="col-sm-12">
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
                    </div>
                    <div class="card-header bg-danger">
                        <h4 class="card-title font-weight-bold text-uppercase text-white">Project Details:-</h4>
                    </div>
                    <div class="card-body FEF1F1">
                        <form method="post" action="{{route('uploadProjectData')}}" enctype="multipart/form-data" class="card-body row">
                            @csrf
                            {{-- <h4 class="card-title font-weight-bold text-uppercase text-primary">Project Details:-</h4><hr> --}}
                                    <div class="col-sm-4">
                                        <label for="company_id" class="col-form-label">Select Company <star>*</star></label>
                                        <select class="form-select" required type="text" name="company_id" id="company_id">
                                            <option selected disabled>---Select Company----</option>
                                            @foreach ($companydata as $citem)
                                                <option value="{{$citem->company_id}}">{{$citem->company_name}}</option>                                            
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('company_id') Project category name is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="project_id" class="col-form-label">Select Project Category<star>*</star></label>
                                        <select class="form-select" required type="text" name="project_id" id="project_id" >
                                            <option value="" selected disabled>--Select Project Category--</option><option value="" selected disabled>--Select Project Category--</option>
                                            {{-- @foreach ($projectdata as $pitem)
                                                <option value="{{$pitem->project_cat_id}}">{{$pitem->project_category}}</option>                                            
                                            @endforeach --}}
                                        </select>  
                                        {{-- <input type="text" id="project_id" class="form-control"> --}}
                                        <small class="form-text text-danger">@error('project_id') Project category name is required. @enderror</small> 
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="distributorID" class="col-form-label">Select Distributor <star>*</star></label>
                                        <select class="form-select" required name="distributor_id" id="distributorID">
                                            <option selected disabled value="">---Select Distributor---</option>
                                            @foreach ($distributordata as $ditem)
                                            @php
                                                $get_dist_name = \App\Models\User::where('user_id',$ditem->user_id)->first();
                                            @endphp
                                                <option value="{{$ditem->distributor_reg}}">{{$get_dist_name->name}}</option>                                            
                                            @endforeach
                                        </select>
                                        <small class="form-text text-danger">@error('distributor_id') Project category name is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="ProjectName" class="col-form-label">Project Name <star>*</star></label>
                                        <input class="form-control" required type="text" name="project_name" placeholder="Project Name" id="ProjectName">
                                        <small class="form-text text-danger">@error('project_name') Project category name is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="ProjectNumber" class="col-form-label">Project Number <star>*</star></label>
                                        <input class="form-control" required type="text" name="project_number" placeholder="Project Number" id="ProjectNumber">
                                        <small class="form-text text-danger">@error('project_number') Project category name is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="categorytype" class="col-form-label">Select Type <star>*</star></label>
                                        <select name="prjecttype" id="categorytype" class="form-select">
                                            <option selected disabled value="">---Select Project Type---</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Emergency">Emergency</option>
                                        </select>
                                        <small class="form-text text-danger">@error('prjecttype') Category type is required. @enderror</small>
                                    </div>  
                                    <div class="col-sm-4">
                                        <label for="noDays" class="col-form-label">Select Project End Date <star>*</star></label>
                                        <input type="date" class="form-control" id="noDays" name="no_of_days" required>
                                        <small class="form-text text-danger">@error('no_of_days') No of days is required. @enderror</small>
                                    </div> 
                                    {{-- <div class="col-sm-4">
                                        <label for="projectAmount" class="col-form-label">Project Amount <star>*</star></label>
                                        <input class="form-control" required type="text" name="project_amount" readonly placeholder="Project Amount" id="projectAmount">
                                        <small class="form-text text-danger">@error('project_amount') Project category name is required. @enderror</small>
                                    </div> --}}
                                    <div class="col-sm-4">
                                       <label class="col-form-label" for="projectAmount">Project Amount</label>
                                            <div class="input-group mb-2">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">Rs</div>
                                              </div>
                                              <input type="number" readonly name="project_amount" required class="form-control" id="projectAmount" placeholder="Project Amount">
                                            </div>
                                        <small class="form-text text-danger">@error('project_amount') Amount is required. @enderror</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="distributeAmount">Distrbute Amount</label>
                                             <div class="input-group mb-2">
                                               <div class="input-group-prepend">
                                                 <div class="input-group-text">Rs</div>
                                               </div>
                                               <input type="number" name="distribute_amount" required class="form-control" id="distributeAmount" placeholder="Distrbute Amount">
                                             </div>
                                         <small class="form-text text-danger">@error('distribute_amount') Distribute Amount is required. @enderror</small>
                                     </div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <button name="add_project" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create Project</button>
                                    </div>
    
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
  
    jQuery(document).ready(function(){
        jQuery('#company_id').change(function(){
            let company=jQuery(this).val();
            let datas = "";
            console.log(company)
    // $('#sub_category').empty();
    // $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
            jQuery.ajax({
                url:'{{url('getProjectName')}}',
                type:'post',
                data:'company='+company+'&_token={{csrf_token()}}',
                success:function(result){
                    // jQuery('#project_id').val(''+result+'')
                    if (result == '') {
                        datas += '<option>Not Found.</option>';
                    } else{
                        // console.log(result);
                        $.each(result, function (i) {
                            datas += '<option value="'+result[i].project_cat_id+'">'+result[i].project_category+'</option>';
                            // console.log(datas);
                        });                    
                    }
                    jQuery('#project_id').html(datas);
                }
            });
        });
        
        jQuery('#project_id').change(function(){
            let cid=jQuery(this).val();
            console.log(cid)
    // $('#sub_category').empty();
    // $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
            jQuery.ajax({
                url:'{{url('getamountofproject')}}',
                type:'post',
                data:'cid='+cid+'&_token={{csrf_token()}}',
                success:function(result){
                    jQuery('#projectAmount').val(result)
                    // console.log(result);
                }
            });
        });


    });
</script>
@endsection
