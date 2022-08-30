@extends('admin.layouts.master')
@section('title','Update Project Category')
@section('content')
    <style>
        .currency_sign{
            width: 100px;
            outline: none;
            border: none;
            background: transparent;
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
                    <div class="col-sm-12 p-2">
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
                    <form method="post" action="{{route('admin.updateProjectCategoryDetails')}}" enctype="multipart/form-data" class="card-body">
                        @csrf
                        <h4 class="card-title font-weight-bold text-uppercase text-primary">Project Category Details:-</h4><hr>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label for="Company" class="col-form-label">Select Company <star>*</star></label>
                                    <select class="form-select" required type="text" name="company_id" id="Company">
                                        <option selected disabled value="">---Select Company----</option>
                                        @foreach ($companydata as $citem)
                                            <option @if($pro_category_data->company_id==$citem->company_id)selected @endif value="{{$citem->company_id}}">{{$citem->company_name}}</option>                                            
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{ $pro_category_data->project_cat_id }}" id="" name="pro_category_id">
                                    <small class="form-text text-danger">@error('company_id') Project category name is required. @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ProjectName" class="col-form-label">Project Category Name <star>*</star></label>
                                    <input class="form-control" required value="{{ $pro_category_data->project_category }}" type="text" name="project_cat_name" placeholder="Project Category Name" value="{{old('project_cat_name')}}" id="ProjectName">
                                    <small class="form-text text-danger">@error('project_cat_name') Project category name is required. @enderror</small>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="projectAmount">Set Project Amount </label>
                                         <div class="input-group mb-2">
                                           <div class="input-group-prepend">
                                             <div class="input-group-text">
                                                <select name="currency" class="currency_sign">
                                                    <option selected value="{{ $pro_category_data->currency }}">{{ $pro_category_data->currency }}</option>
                                                    <option value="USD">$</option>
                                                    <option value="EUR">€</option>
                                                    <option value="GBP">United Kingdom Pounds(£)</option>
                                                    <option value="DZD">Algeria Dinars</option>
                                                    <option value="ARP">Argentina Pesos</option>
                                                    <option value="AUD">Australia Dollars</option>
                                                    <option value="ATS">Austria Schillings</option>
                                                    <option value="BSD">Bahamas Dollars</option>
                                                    <option value="BBD">Barbados Dollars</option>
                                                    <option value="BEF">Belgium Francs</option>
                                                    <option value="BMD">Bermuda Dollars</option>
                                                    <option value="BRR">Brazil Real</option>
                                                    <option value="BGL">Bulgaria Lev</option>
                                                    <option value="CAD">Canada Dollars</option>
                                                    <option value="CLP">Chile Pesos</option>
                                                    <option value="CNY">China Yuan Renmimbi</option>
                                                    <option value="CYP">Cyprus Pounds</option>
                                                    <option value="CSK">Czech Republic Koruna</option>
                                                    <option value="DKK">Denmark Kroner</option>
                                                    <option value="NLG">Dutch Guilders</option>
                                                    <option value="XCD">Eastern Caribbean Dollars</option>
                                                    <option value="EGP">Egypt Pounds</option>
                                                    <option value="FJD">Fiji Dollars</option>
                                                    <option value="FIM">Finland Markka</option>
                                                    <option value="FRF">France Francs</option>
                                                    <option value="DEM">Germany Deutsche Marks</option>
                                                    <option value="XAU">Gold Ounces</option>
                                                    <option value="GRD">Greece Drachmas</option>
                                                    <option value="HKD">Hong Kong Dollars</option>
                                                    <option value="HUF">Hungary Forint</option>
                                                    <option value="ISK">Iceland Krona</option>
                                                    <option value="INR">India Rupees</option>
                                                    <option value="IDR">Indonesia Rupiah</option>
                                                    <option value="IEP">Ireland Punt</option>
                                                    <option value="ILS">Israel New Shekels</option>
                                                    <option value="ITL">Italy Lira</option>
                                                    <option value="JMD">Jamaica Dollars</option>
                                                    <option value="JPY">Japan Yen</option>
                                                    <option value="JOD">Jordan Dinar</option>
                                                    <option value="KRW">Korea (South) Won</option>
                                                    <option value="LBP">Lebanon Pounds</option>
                                                    <option value="LUF">Luxembourg Francs</option>
                                                    <option value="MYR">Malaysia Ringgit</option>
                                                    <option value="MXP">Mexico Pesos</option>
                                                    <option value="NLG">Netherlands Guilders</option>
                                                    <option value="NZD">New Zealand Dollars</option>
                                                    <option value="NOK">Norway Kroner</option>
                                                    <option value="PKR">Pakistan Rupees</option>
                                                    <option value="XPD">Palladium Ounces</option>
                                                    <option value="PHP">Philippines Pesos</option>
                                                    <option value="XPT">Platinum Ounces</option>
                                                    <option value="PLZ">Poland Zloty</option>
                                                    <option value="PTE">Portugal Escudo</option>
                                                    <option value="ROL">Romania Leu</option>
                                                    <option value="RUR">Russia Rubles</option>
                                                    <option value="SAR">Saudi Arabia Riyal</option>
                                                    <option value="XAG">Silver Ounces</option>
                                                    <option value="SGD">Singapore Dollars</option>
                                                    <option value="SKK">Slovakia Koruna</option>
                                                    <option value="ZAR">South Africa Rand</option>
                                                    <option value="KRW">South Korea Won</option>
                                                    <option value="ESP">Spain Pesetas</option>
                                                    <option value="XDR">Special Drawing Right (IMF)</option>
                                                    <option value="SDD">Sudan Dinar</option>
                                                    <option value="SEK">Sweden Krona</option>
                                                    <option value="CHF">Switzerland Francs</option>
                                                    <option value="TWD">Taiwan Dollars</option>
                                                    <option value="THB">Thailand Baht</option>
                                                    <option value="TTD">Trinidad and Tobago Dollars</option>
                                                    <option value="TRL">Turkey Lira</option>
                                                    <option value="VEB">Venezuela Bolivar</option>
                                                    <option value="ZMK">Zambia Kwacha</option>
                                                    <option value="EUR">Euro</option>
                                                    <option value="XCD">Eastern Caribbean Dollars</option>
                                                    <option value="XDR">Special Drawing Right (IMF)</option>
                                                    <option value="XAG">Silver Ounces</option>
                                                    <option value="XAU">Gold Ounces</option>
                                                    <option value="XPD">Palladium Ounces</option>
                                                    <option value="XPT">Platinum Ounces</option>
                                                </select>

                                             </div>
                                           </div>
                                           <input class="form-control" value="{{ $pro_category_data->project_amount }}" required type="number" name="project_amount" placeholder="Enter Project Amount" id="ProjectAmount">
                                         </div>
                                     <small class="form-text text-danger">@error('project_amount') Amount is required. @enderror</small>
                                 </div>
                                {{-- <div class="col-sm-4">
                                    <label for="ProjectAmount" class="col-form-label">Set Project Amount <star>*</star></label>
                                    <input class="form-control" required type="number" name="project_amount" value="{{old('project_amount')}}" placeholder="Enter Project Amount" id="ProjectAmount">
                                    <small class="form-text text-danger">@error('project_amount') Project amount is required. @enderror</small>
                                </div> --}}
                                <div class="col-sm-4">
                                    <label for="ProjectAmount" class="col-form-label">Set Distribute Amount <star>*</star></label>
                                    <input class="form-control" required type="number" value="{{ $pro_category_data->distribute_amount }}" name="distribute_amount" placeholder="Enter Distribute Amount" id="ProjectAmount">
                                    <small class="form-text text-danger">@error('distribute_amount') Distribute amount is required. @enderror</small>
                                </div>  
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="add_project_category" type="submit" class="btn btn-danger"><i class="fa fa-paper-plane"></i> Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
     </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection
