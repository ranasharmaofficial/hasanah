@extends('admin.layouts.master')
@section('title','Home')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      <?= $chartData; ?>
    ]);

    var options = {
      title: 'Project Status Report',
    //   is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>
<!-- jquery.vectormap css -->
<link href="{{asset('assets_admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="{{asset('assets_admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('assets_admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                 
                                    
                                        <div id="piechart" style="width: 1050px; height: 1000px;"></div>
                                     
                                    
                                </div>
                            </div>
                        </div>
                    </div><!--End column--->
                   
                    
                </div>
                <!-- end row -->

                
            </div>

            
        </div>
        <!-- end row -->

        @if (false)
        
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body border-bottom">

                        <div class="user-chat-border">
                            <div class="row">
                                <div class="col-md-5 col-9">
                                    <h5 class="font-size-15 mb-1">Frank Vickery</h5>
                                    <p class="text-muted mb-0"><i
                                            class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                </div>
                                <div class="col-md-7 col-3">
                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                        <li class="list-inline-item">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                                                    <form class="p-2">
                                                        <div class="search-box">
                                                            <div class="position-relative">
                                                                <input type="text"
                                                                    class="form-control rounded bg-light border-0"
                                                                    placeholder="Search...">
                                                                <i class="mdi mdi-magnify search-icon"></i>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item d-none d-sm-inline-block">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-cog"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">View Profile</a>
                                                    <a class="dropdown-item" href="#">Clear chat</a>
                                                    <a class="dropdown-item" href="#">Muted</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-inline-item">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else</a>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chat-widget">
                            <div class="chat-conversation" data-simplebar style="max-height: 295px;">
                                <ul class="list-unstyled mb-0 pe-3">
                                    <li>
                                        <div class="conversation-list">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-2.jpg" alt="avatar-2">
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Frank Vickery</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Hey! I am available
                                                    </p>
                                                </div>
                                                <p class="chat-time mb-0"><i
                                                        class="mdi mdi-clock-outline align-middle me-1"></i> 12:09</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li class="right">
                                        <div class="conversation-list">
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Ricky Clark</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Hi, How are you? What about our next meeting?
                                                    </p>
                                                </div>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="chat-day-title">
                                            <span class="title">Today</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="conversation-list">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-2.jpg" alt="avatar-2">
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Frank Vickery</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Hello!
                                                    </p>
                                                </div>
                                                <p class="chat-time mb-0"><i
                                                        class="mdi mdi-clock-outline align-middle me-1"></i> 10:00</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li class="right">
                                        <div class="conversation-list">
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Ricky Clark</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Hi, How are you? What about our next meeting?
                                                    </p>
                                                </div>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="conversation-list">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-2.jpg" alt="avatar-2">
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Frank Vickery</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Yeah everything is fine
                                                    </p>
                                                </div>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li>
                                        <div class="conversation-list">
                                            <div class="chat-avatar">
                                                <img src="assets/images/users/avatar-2.jpg" alt="avatar-2">
                                            </div>
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Frank Vickery</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">& Next meeting tomorrow 10.00AM</p>
                                                </div>
                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                            </div>

                                        </div>
                                    </li>

                                    <li class="right">
                                        <div class="conversation-list">
                                            <div class="ctext-wrap">
                                                <div class="conversation-name">Ricky Clark</div>
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        Wow that's great
                                                    </p>
                                                </div>

                                                <p class="chat-time mb-0"><i
                                                        class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 chat-input-section border-top">
                        <div class="row">
                            <div class="col">
                                <div>
                                    <input type="text" class="form-control rounded chat-input ps-3"
                                        placeholder="Enter Message...">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit"
                                    class="btn btn-primary chat-send w-md waves-effect waves-light"><span
                                        class="d-none d-sm-inline-block me-2">Send</span> <i
                                        class="mdi mdi-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Latest Transactions</h4>

                        <div class="table-responsive">
                            <table class="table table-centered datatable dt-responsive nowrap" data-bs-page-length="5"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck">
                                                <label class="form-check-label mb-0" for="ordercheck">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Billing Name</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck1">
                                                <label class="form-check-label mb-0" for="ordercheck1">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1572</a> </td>
                                        <td>
                                            04 Apr, 2020
                                        </td>
                                        <td>Walter Brown</td>

                                        <td>
                                            $172
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-success font-size-12">Paid</div>
                                        </td>
                                        <td id="tooltip-container1">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck2">
                                                <label class="form-check-label mb-0" for="ordercheck2">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1571</a> </td>
                                        <td>
                                            03 Apr, 2020
                                        </td>
                                        <td>Jimmy Barker</td>

                                        <td>
                                            $165
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-warning font-size-12">unpaid</div>
                                        </td>
                                        <td id="tooltip-container2">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck3">
                                                <label class="form-check-label mb-0" for="ordercheck3">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1570</a> </td>
                                        <td>
                                            03 Apr, 2020
                                        </td>
                                        <td>Donald Bailey</td>

                                        <td>
                                            $146
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-success font-size-12">Paid</div>
                                        </td>
                                        <td id="tooltip-container3">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container3" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container3" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck4">
                                                <label class="form-check-label mb-0" for="ordercheck4">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1569</a> </td>
                                        <td>
                                            02 Apr, 2020
                                        </td>
                                        <td>Paul Jones</td>

                                        <td>
                                            $183
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-success font-size-12">Paid</div>
                                        </td>
                                        <td id="tooltip-container41">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container41" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container41" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck5">
                                                <label class="form-check-label mb-0" for="ordercheck5">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1568</a> </td>
                                        <td>
                                            01 Apr, 2020
                                        </td>
                                        <td>Jefferson Allen</td>

                                        <td>
                                            $160
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-danger font-size-12">Chargeback</div>
                                        </td>
                                        <td id="tooltip-container4">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container4" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container4" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck6">
                                                <label class="form-check-label mb-0" for="ordercheck6">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1567</a> </td>
                                        <td>
                                            31 Mar, 2020
                                        </td>
                                        <td>Jeffrey Waltz</td>

                                        <td>
                                            $105
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-warning font-size-12">unpaid</div>
                                        </td>
                                        <td id="tooltip-container5">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container5" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container5" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck7">
                                                <label class="form-check-label mb-0" for="ordercheck7">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1566</a> </td>
                                        <td>
                                            30 Mar, 2020
                                        </td>
                                        <td>Jewel Buckley</td>

                                        <td>
                                            $112
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-success font-size-12">Paid</div>
                                        </td>
                                        <td id="tooltip-container6">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container6" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container6" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck8">
                                                <label class="form-check-label mb-0" for="ordercheck8">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1565</a> </td>
                                        <td>
                                            29 Mar, 2020
                                        </td>
                                        <td>Jamison Clark</td>

                                        <td>
                                            $123
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-success font-size-12">Paid</div>
                                        </td>
                                        <td id="tooltip-container7">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container7" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container7" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck9">
                                                <label class="form-check-label mb-0" for="ordercheck9">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1564</a> </td>
                                        <td>
                                            28 Mar, 2020
                                        </td>
                                        <td>Eddy Torres</td>

                                        <td>
                                            $141
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-success font-size-12">Paid</div>
                                        </td>
                                        <td id="tooltip-container8">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container8" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container8" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="ordercheck10">
                                                <label class="form-check-label mb-0" for="ordercheck10">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-dark fw-bold">#NZ1563</a> </td>
                                        <td>
                                            28 Mar, 2020
                                        </td>
                                        <td>Frank Dean</td>

                                        <td>
                                            $164
                                        </td>
                                        <td>
                                            <div class="badge badge-soft-warning font-size-12">unpaid</div>
                                        </td>
                                        <td id="tooltip-container9">
                                            <a href="javascript:void(0);" class="me-3 text-primary"
                                                data-bs-container="#tooltip-container9" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="text-danger"
                                                data-bs-container="#tooltip-container9" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i
                                                    class="mdi mdi-trash-can font-size-18"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @endif
    </div>

</div>
<!-- End Page-content -->

<!-- apexcharts -->
<script src="{{asset('assets_admin/libs/apexcharts/apexcharts.min.jssssss')}}"></script>
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
@endsection