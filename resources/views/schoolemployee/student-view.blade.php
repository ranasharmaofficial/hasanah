@extends('schoolemployee.layouts.master')
@section('title','Student List')
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
                    <div class="card-header bg-dark">
                        <h3 class="card-title text-white">@yield('title')</h3>
                        <p class="p-0 m-0 text-white">Total Students: <b>{{$studentlists->total();}}</b>, Page No: <b>{{$studentlists->currentPage();}}</b></p>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($studentlists as $key => $studentlist)
                                <tr>
                                    <td>{{($studentlists->currentpage()-1) * $studentlists->perpage() + $key + 1}}</td>
                                    <td>{{$studentlist->student_id}}</td>
                                    <td>{{$studentlist->name}}</td>
                                    <td>{{$studentlist->mobile}}</td>
                                    <td>{{$studentlist->email}}</td>
                                    <td>
                                        @if ($studentlist->status == '1')
                                        <span class="text-success">Active</span>
                                        @else
                                        <span class="text-danger">Blocked</span>
                                        @endif
                                    </td>
                                    <td><button class="btn btn-primary"><i class="fa fa-eye"></i></button></td>
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
