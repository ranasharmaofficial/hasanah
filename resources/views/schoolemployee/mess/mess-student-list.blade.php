@extends('schoolemployee.layouts.master')
@section('title','Mess Student List')
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
                        <p class="p-0 m-0 text-white">Total Mess Student: <b>{{$studentlists->total();}}</b>, Page No: <b>{{$studentlists->currentPage();}}</b></p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Student ID</th>
                                    <th>Roll Number</th>
                                    <th>Student Name</th>
                                    <th>Joining Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($studentlists as $key => $data)
                                <tr>
                                    <td>{{($studentlists->currentpage()-1) * $studentlists->perpage() + $key + 1}}</td>
                                    <td>{{$data->student_id}}</td>
                                    <td>{{$data->roll_number}}</td>
                                    <td>{{$data->name}}</td>
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
                                                {{$studentlists->links();}}
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
