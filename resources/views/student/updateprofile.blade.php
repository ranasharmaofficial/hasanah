@extends('student.layouts.master')
@section('title', 'Update Profile')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div  style="float:right;" class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title align-items-right text-right">
                            <h4 class="text-right"><span class="text-primary"> Student Panel</span></h4>
                         </div>
    
    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
							<h4 class="card-title">@yield('title')</h4>
                            <form action="" method="POST" class="row">
                                @csrf
                                <div class="col-sm-6">
                                    <label for="Project" class="col-form-label">Name <star>*</star></label>
                                    <input type="text" class="form-control" value="{{$studentdata->name}}" name="name" id="Project" required>
                                    <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Mobile" class="col-form-label">Mobile <star>*</star></label>
                                    <input type="text" readonly class="form-control" value="{{$studentdata->mobile}}" id="Mobile" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="Email" class="col-form-label">Email <star>*</star></label>
                                    <input type="text" value="{{$studentdata->email}}" class="form-control" name="email" id="Email" required>
                                    <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                                </div>
                                
                                <div class="col-sm-12 mt-3 text-center">
                                    <button name="submit" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row --> 
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
